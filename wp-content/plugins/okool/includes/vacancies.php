<?php
/**
 * Vacancies: listed at /careers/vacancies/ (Figma 697:579) with a page per role.
 *
 * Each vacancy has a department, location and job type; title, summary (excerpt) and
 * description come from the editor, with an Arabic version in the shared "Arabic version" box.
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const OKOOL_VACANCY_TYPE = 'okool_vacancy';

/**
 * Departments: key => [ label, icon ].
 *
 * @return array<string, array{0: string, 1: string}>
 */
function okool_vacancy_departments() {
	return [
		'workforce'  => [ __( 'Workforce Solutions', 'okool' ), 'svc-people' ],
		'facilities' => [ __( 'Facilities Management', 'okool' ), 'svc-building' ],
		'security'   => [ __( 'Security Services', 'okool' ), 'svc-shield' ],
	];
}

/**
 * Locations, keyed by stored value.
 *
 * @return array<string, string>
 */
function okool_vacancy_locations() {
	return [
		'dubai'     => __( 'Dubai, UAE', 'okool' ),
		'abu-dhabi' => __( 'Abu Dhabi, UAE', 'okool' ),
		'sharjah'   => __( 'Sharjah, UAE', 'okool' ),
		'al-ain'    => __( 'Al Ain, UAE', 'okool' ),
		'multiple'  => __( 'Multiple UAE locations', 'okool' ),
	];
}

/**
 * Job types, keyed by stored value.
 *
 * @return array<string, string>
 */
function okool_vacancy_job_types() {
	return [
		'full-time' => __( 'Full-time', 'okool' ),
		'part-time' => __( 'Part-time', 'okool' ),
		'contract'  => __( 'Contract', 'okool' ),
	];
}

/**
 * Register the Vacancies post type.
 */
function okool_register_vacancy_type() {
	register_post_type(
		OKOOL_VACANCY_TYPE,
		[
			'labels'        => [
				'name'               => __( 'Vacancies', 'okool' ),
				'singular_name'      => __( 'Vacancy', 'okool' ),
				'menu_name'          => __( 'Vacancies', 'okool' ),
				'add_new'            => __( 'Add vacancy', 'okool' ),
				'add_new_item'       => __( 'Add vacancy', 'okool' ),
				'edit_item'          => __( 'Edit vacancy', 'okool' ),
				'view_item'          => __( 'View vacancy', 'okool' ),
				'all_items'          => __( 'All vacancies', 'okool' ),
				'search_items'       => __( 'Search vacancies', 'okool' ),
				'not_found'          => __( 'No vacancies found.', 'okool' ),
				'not_found_in_trash' => __( 'No vacancies in Trash.', 'okool' ),
			],
			'public'        => true,
			'show_in_rest'  => true,
			'menu_position' => 21,
			'menu_icon'     => 'dashicons-id-alt',
			'supports'      => [ 'title', 'editor', 'excerpt', 'revisions' ],
			'has_archive'   => 'careers/vacancies',
			'rewrite'       => [
				'slug'       => 'careers/vacancies',
				'with_front' => false,
				'ep_mask'    => EP_PERMALINK,
			],
		]
	);

	// /careers/vacancies/{role}/apply/ — the application page for a role.
	add_rewrite_endpoint( 'apply', EP_PERMALINK );
}
add_action( 'init', 'okool_register_vacancy_type' );

/**
 * Whether the current request is a role's application page.
 *
 * @return bool
 */
function okool_vacancy_is_apply() {
	global $wp_query;

	return is_singular( OKOOL_VACANCY_TYPE ) && isset( $wp_query->query_vars['apply'] );
}

/**
 * Address of a role's application page.
 *
 * @param int|WP_Post $post Vacancy.
 * @return string
 */
function okool_vacancy_apply_url( $post ) {
	return trailingslashit( get_permalink( $post ) ) . 'apply/';
}

/**
 * Vacancies get the shared "Arabic version" box.
 *
 * @param string[] $types Post types.
 * @return string[]
 */
function okool_vacancy_ar_type( $types ) {
	$types[] = OKOOL_VACANCY_TYPE;
	return $types;
}
add_filter( 'okool_ar_post_types', 'okool_vacancy_ar_type' );

/**
 * Flush rewrite rules once so /careers/vacancies/ resolves.
 */
function okool_vacancy_flush_rewrites() {
	if ( '2' === get_option( 'okool_vacancy_rewrite' ) ) {
		return;
	}

	flush_rewrite_rules( false );
	update_option( 'okool_vacancy_rewrite', '2', false );
}
add_action( 'init', 'okool_vacancy_flush_rewrites', 30 );

/**
 * Show every vacancy on the listing (filters narrow it down).
 *
 * @param WP_Query $query Main query.
 */
function okool_vacancy_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_post_type_archive( OKOOL_VACANCY_TYPE ) ) {
		return;
	}

	$query->set( 'posts_per_page', -1 );
}
add_action( 'pre_get_posts', 'okool_vacancy_query' );

/**
 * A vacancy's department, location and job type, with labels.
 *
 * @param int $post_id Vacancy ID.
 * @return array{department: string, department_label: string, icon: string, location: string, location_label: string, type_label: string, sample: bool}
 */
function okool_vacancy_meta( $post_id ) {
	$departments = okool_vacancy_departments();
	$locations   = okool_vacancy_locations();
	$types       = okool_vacancy_job_types();

	$department = (string) get_post_meta( $post_id, '_okool_department', true );
	$location   = (string) get_post_meta( $post_id, '_okool_location', true );
	$type       = (string) get_post_meta( $post_id, '_okool_job_type', true );

	return [
		'department'       => $department,
		'department_label' => isset( $departments[ $department ] ) ? $departments[ $department ][0] : '',
		'icon'             => isset( $departments[ $department ] ) ? $departments[ $department ][1] : 'svc-people',
		'location'         => $location,
		'location_label'   => isset( $locations[ $location ] ) ? $locations[ $location ] : '',
		'type_label'       => isset( $types[ $type ] ) ? $types[ $type ] : '',
		'sample'           => (bool) get_post_meta( $post_id, '_okool_sample', true ),
	];
}

/**
 * "Role details" box: department, location and job type.
 */
function okool_vacancy_meta_box() {
	add_meta_box(
		'okool-vacancy-details',
		__( 'Role details', 'okool' ),
		static function ( $post ) {
			wp_nonce_field( 'okool_vacancy_details', '_okool_vacancy_nonce' );

			$fields = [
				'_okool_department' => [ __( 'Department', 'okool' ), wp_list_pluck( okool_vacancy_departments(), 0 ) ],
				'_okool_location'   => [ __( 'Location', 'okool' ), okool_vacancy_locations() ],
				'_okool_job_type'   => [ __( 'Job type', 'okool' ), okool_vacancy_job_types() ],
			];

			foreach ( $fields as $key => $field ) {
				$current = (string) get_post_meta( $post->ID, $key, true );
				printf( '<p><label for="%1$s"><strong>%2$s</strong></label><br><select id="%1$s" name="okool_vacancy[%1$s]" class="widefat">', esc_attr( $key ), esc_html( $field[0] ) );
				foreach ( $field[1] as $value => $label ) {
					printf( '<option value="%1$s"%2$s>%3$s</option>', esc_attr( $value ), selected( $current, $value, false ), esc_html( $label ) );
				}
				echo '</select></p>';
			}

			echo '<p class="description">' . esc_html__( 'The summary shown on the listing card comes from the Excerpt field.', 'okool' ) . '</p>';
		},
		OKOOL_VACANCY_TYPE,
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes_' . OKOOL_VACANCY_TYPE, 'okool_vacancy_meta_box' );

/**
 * Save the role details.
 *
 * @param int $post_id Post ID.
 */
function okool_vacancy_save( $post_id ) {
	if (
		( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		|| ! isset( $_POST['_okool_vacancy_nonce'], $_POST['okool_vacancy'] )
		|| ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['_okool_vacancy_nonce'] ) ), 'okool_vacancy_details' )
		|| ! current_user_can( 'edit_post', $post_id )
	) {
		return;
	}

	$input   = wp_unslash( $_POST['okool_vacancy'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- each value is checked against a fixed list.
	$allowed = [
		'_okool_department' => okool_vacancy_departments(),
		'_okool_location'   => okool_vacancy_locations(),
		'_okool_job_type'   => okool_vacancy_job_types(),
	];

	foreach ( $allowed as $key => $options ) {
		$value = isset( $input[ $key ] ) ? sanitize_key( $input[ $key ] ) : '';

		if ( isset( $options[ $value ] ) ) {
			update_post_meta( $post_id, $key, $value );
		}
	}
}
add_action( 'save_post_' . OKOOL_VACANCY_TYPE, 'okool_vacancy_save' );

/**
 * Admin list columns.
 *
 * @param string[] $columns Columns.
 * @return string[]
 */
function okool_vacancy_columns( $columns ) {
	$date = $columns['date'];
	unset( $columns['date'] );

	$columns['department'] = __( 'Department', 'okool' );
	$columns['location']   = __( 'Location', 'okool' );
	$columns['date']       = $date;

	return $columns;
}
add_filter( 'manage_' . OKOOL_VACANCY_TYPE . '_posts_columns', 'okool_vacancy_columns' );

/**
 * Admin list column values.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function okool_vacancy_column_value( $column, $post_id ) {
	$meta = okool_vacancy_meta( $post_id );

	if ( 'department' === $column ) {
		echo esc_html( $meta['department_label'] );
	} elseif ( 'location' === $column ) {
		echo esc_html( $meta['location_label'] );
	}
}
add_action( 'manage_' . OKOOL_VACANCY_TYPE . '_posts_custom_column', 'okool_vacancy_column_value', 10, 2 );

/**
 * Starter vacancies, open for applications, with Arabic versions.
 *
 * @return array<int, array<string, mixed>>
 */
function okool_vacancy_samples() {
	return [
		[
			'title'      => 'Recruitment Coordinator',
			'department' => 'workforce',
			'location'   => 'dubai',
			'type'       => 'full-time',
			'excerpt'    => 'Help the recruitment team coordinate interviews, maintain candidate records, and keep hiring teams informed.',
			'content'    => "<h2>Responsibilities</h2>\n<ul>\n<li>Schedule interviews and confirm arrangements with candidates.</li>\n<li>Maintain candidate records and update hiring trackers.</li>\n<li>Coordinate feedback and support onboarding handovers.</li>\n</ul>\n<h2>Requirements</h2>\n<ul>\n<li>Experience in recruitment coordination or administrative support.</li>\n<li>Strong organization and communication skills.</li>\n<li>Confidence working with spreadsheets and shared records.</li>\n</ul>",
			'ar'         => [
				'title'   => 'منسّق توظيف',
				'excerpt' => 'مساعدة فريق التوظيف في تنسيق المقابلات، والحفاظ على سجلات المرشحين، وإبقاء فرق التوظيف على اطلاع.',
				'content' => "<h2>المسؤوليات</h2>\n<ul>\n<li>جدولة المقابلات وتأكيد الترتيبات مع المرشحين.</li>\n<li>الحفاظ على سجلات المرشحين وتحديث متابعة التوظيف.</li>\n<li>تنسيق الملاحظات ودعم تسليم إجراءات التهيئة.</li>\n</ul>\n<h2>المتطلبات</h2>\n<ul>\n<li>خبرة في تنسيق التوظيف أو الدعم الإداري.</li>\n<li>مهارات قوية في التنظيم والتواصل.</li>\n<li>الثقة في العمل على جداول البيانات والسجلات المشتركة.</li>\n</ul>",
			],
		],
		[
			'title'      => 'Facilities Technician',
			'department' => 'facilities',
			'location'   => 'abu-dhabi',
			'type'       => 'full-time',
			'excerpt'    => 'Support routine inspections and maintenance across commercial facilities, and help resolve day-to-day site issues.',
			'content'    => "<h2>Responsibilities</h2>\n<ul>\n<li>Carry out routine inspections of HVAC, electrical and plumbing systems.</li>\n<li>Complete preventive maintenance tasks and record the work done.</li>\n<li>Respond to day-to-day site issues and escalate where needed.</li>\n</ul>\n<h2>Requirements</h2>\n<ul>\n<li>Technical diploma or equivalent experience in building maintenance.</li>\n<li>Experience working in commercial facilities.</li>\n<li>Good awareness of on-site safety practices.</li>\n</ul>",
			'ar'         => [
				'title'   => 'فني مرافق',
				'excerpt' => 'دعم الفحوصات الدورية وأعمال الصيانة في المرافق التجارية، والمساعدة في حل المشكلات اليومية في الموقع.',
				'content' => "<h2>المسؤوليات</h2>\n<ul>\n<li>إجراء الفحوصات الدورية لأنظمة التكييف والكهرباء والسباكة.</li>\n<li>تنفيذ مهام الصيانة الوقائية وتوثيق الأعمال المنجزة.</li>\n<li>الاستجابة للمشكلات اليومية في الموقع وتصعيدها عند الحاجة.</li>\n</ul>\n<h2>المتطلبات</h2>\n<ul>\n<li>دبلوم فني أو خبرة مماثلة في صيانة المباني.</li>\n<li>خبرة في العمل في المرافق التجارية.</li>\n<li>وعي جيد بممارسات السلامة في الموقع.</li>\n</ul>",
			],
		],
		[
			'title'      => 'Site Security Officer',
			'department' => 'security',
			'location'   => 'dubai',
			'type'       => 'full-time',
			'excerpt'    => 'Support site access, visitor management, and incident reporting at an assigned location.',
			'content'    => "<h2>Responsibilities</h2>\n<ul>\n<li>Control site access and manage visitors.</li>\n<li>Carry out patrols and report incidents accurately.</li>\n<li>Follow post orders and site-specific instructions.</li>\n</ul>\n<h2>Requirements</h2>\n<ul>\n<li>Valid UAE security licence or eligibility to obtain one.</li>\n<li>Previous experience in a security role.</li>\n<li>Clear communication and a professional manner.</li>\n</ul>",
			'ar'         => [
				'title'   => 'موظف أمن موقع',
				'excerpt' => 'دعم التحكم في الدخول إلى الموقع، وإدارة الزوار، والإبلاغ عن الحوادث في موقع محدد.',
				'content' => "<h2>المسؤوليات</h2>\n<ul>\n<li>التحكم في الدخول إلى الموقع وإدارة الزوار.</li>\n<li>تنفيذ الدوريات والإبلاغ عن الحوادث بدقة.</li>\n<li>الالتزام بتعليمات الموقع والمهام المحددة.</li>\n</ul>\n<h2>المتطلبات</h2>\n<ul>\n<li>رخصة أمن سارية في دولة الإمارات أو الأهلية للحصول عليها.</li>\n<li>خبرة سابقة في مجال الأمن.</li>\n<li>تواصل واضح وأسلوب مهني.</li>\n</ul>",
			],
		],
		[
			'title'      => 'HR & Payroll Administrator',
			'department' => 'workforce',
			'location'   => 'abu-dhabi',
			'type'       => 'full-time',
			'excerpt'    => 'Manage employee records, monthly payroll inputs and visa documentation for outsourced teams across client sites.',
			'content'    => "<h2>Responsibilities</h2>\n<ul>\n<li>Prepare monthly payroll inputs and reconcile attendance records.</li>\n<li>Maintain employee files, contracts and visa documentation.</li>\n<li>Respond to employee queries on salary, leave and benefits.</li>\n</ul>\n<h2>Requirements</h2>\n<ul>\n<li>Experience in HR administration or payroll in the UAE.</li>\n<li>Working knowledge of UAE labour law and WPS.</li>\n<li>Accuracy, discretion and strong spreadsheet skills.</li>\n</ul>",
			'ar'         => [
				'title'   => 'إداري موارد بشرية ورواتب',
				'excerpt' => 'إدارة سجلات الموظفين ومدخلات الرواتب الشهرية ووثائق التأشيرات لفرق العمل الخارجية في مواقع العملاء.',
				'content' => "<h2>المسؤوليات</h2>\n<ul>\n<li>إعداد مدخلات الرواتب الشهرية ومطابقة سجلات الحضور.</li>\n<li>الحفاظ على ملفات الموظفين وعقودهم ووثائق التأشيرات.</li>\n<li>الرد على استفسارات الموظفين بشأن الرواتب والإجازات والمزايا.</li>\n</ul>\n<h2>المتطلبات</h2>\n<ul>\n<li>خبرة في إدارة الموارد البشرية أو الرواتب في دولة الإمارات.</li>\n<li>معرفة عملية بقانون العمل الإماراتي ونظام حماية الأجور.</li>\n<li>الدقة والسرية ومهارات قوية في جداول البيانات.</li>\n</ul>",
			],
		],
		[
			'title'      => 'HVAC Technician',
			'department' => 'facilities',
			'location'   => 'sharjah',
			'type'       => 'contract',
			'excerpt'    => 'Carry out preventive and corrective maintenance on HVAC systems to keep client facilities comfortable and running efficiently.',
			'content'    => "<h2>Responsibilities</h2>\n<ul>\n<li>Inspect, service and repair chillers, AHUs, FCUs and split units.</li>\n<li>Follow planned maintenance schedules and record readings.</li>\n<li>Diagnose faults and respond to breakdown calls on site.</li>\n</ul>\n<h2>Requirements</h2>\n<ul>\n<li>Technical qualification in HVAC or refrigeration.</li>\n<li>Experience maintaining commercial HVAC systems.</li>\n<li>Safe working practices and a valid UAE driving licence is an advantage.</li>\n</ul>",
			'ar'         => [
				'title'   => 'فني تكييف وتهوية',
				'excerpt' => 'تنفيذ أعمال الصيانة الوقائية والتصحيحية لأنظمة التكييف والتهوية للحفاظ على راحة مرافق العملاء وكفاءة تشغيلها.',
				'content' => "<h2>المسؤوليات</h2>\n<ul>\n<li>فحص وصيانة وإصلاح المبرّدات ووحدات مناولة الهواء ووحدات الملف والمروحة والوحدات المنفصلة.</li>\n<li>اتباع جداول الصيانة المخطط لها وتسجيل القراءات.</li>\n<li>تشخيص الأعطال والاستجابة لبلاغات الأعطال في الموقع.</li>\n</ul>\n<h2>المتطلبات</h2>\n<ul>\n<li>مؤهل فني في التكييف أو التبريد.</li>\n<li>خبرة في صيانة أنظمة التكييف التجارية.</li>\n<li>ممارسات عمل آمنة، ويُفضَّل امتلاك رخصة قيادة إماراتية سارية.</li>\n</ul>",
			],
		],
		[
			'title'      => 'Security Supervisor',
			'department' => 'security',
			'location'   => 'abu-dhabi',
			'type'       => 'full-time',
			'excerpt'    => 'Lead a team of security officers on site, manage shift rosters and make sure post orders and reporting standards are followed.',
			'content'    => "<h2>Responsibilities</h2>\n<ul>\n<li>Supervise security officers and brief each shift on site requirements.</li>\n<li>Prepare rosters, check attendance and conduct post inspections.</li>\n<li>Review incident reports and liaise with the client and site management.</li>\n</ul>\n<h2>Requirements</h2>\n<ul>\n<li>Valid UAE security licence with supervisory experience.</li>\n<li>Experience managing teams on commercial or government sites.</li>\n<li>Clear written and spoken communication in English; Arabic is an advantage.</li>\n</ul>",
			'ar'         => [
				'title'   => 'مشرف أمن',
				'excerpt' => 'قيادة فريق من موظفي الأمن في الموقع، وإعداد جداول المناوبات، والتأكد من الالتزام بتعليمات المواقع ومعايير الإبلاغ.',
				'content' => "<h2>المسؤوليات</h2>\n<ul>\n<li>الإشراف على موظفي الأمن وإطلاع كل مناوبة على متطلبات الموقع.</li>\n<li>إعداد جداول المناوبات ومتابعة الحضور وإجراء جولات تفقدية على المواقع.</li>\n<li>مراجعة تقارير الحوادث والتنسيق مع العميل وإدارة الموقع.</li>\n</ul>\n<h2>المتطلبات</h2>\n<ul>\n<li>رخصة أمن سارية في دولة الإمارات مع خبرة إشرافية.</li>\n<li>خبرة في إدارة الفرق في مواقع تجارية أو حكومية.</li>\n<li>تواصل واضح كتابةً وتحدثًا باللغة الإنجليزية، وتُعد اللغة العربية ميزة إضافية.</li>\n</ul>",
			],
		],
	];
}

/**
 * Starter vacancies (open for applications): added once, skipping any title that already exists,
 * and never re-added after deletion. Earlier "sample" copies of these roles are opened up too.
 */
function okool_vacancy_seed_samples() {
	global $wpdb;

	$marker = 'okool_vacancy_jobs_v2';

	if ( wp_installing() || get_option( $marker ) ) {
		return;
	}

	$claimed = $wpdb->query( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$wpdb->prepare(
			"INSERT IGNORE INTO {$wpdb->options} (option_name, option_value, autoload) VALUES (%s, %s, 'no')",
			$marker,
			'1'
		)
	);
	wp_cache_delete( 'notoptions', 'options' );
	wp_cache_delete( $marker, 'options' );

	if ( 1 !== (int) $claimed ) {
		return;
	}

	// Open up roles created by earlier versions as design-review samples.
	$old_samples = get_posts(
		[
			'post_type'      => OKOOL_VACANCY_TYPE,
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'meta_key'       => '_okool_sample', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_query_meta_key
		]
	);
	foreach ( $old_samples as $old_id ) {
		delete_post_meta( $old_id, '_okool_sample' );
		update_post_meta( $old_id, '_okool_seeded', 1 );
	}

	foreach ( okool_vacancy_samples() as $i => $sample ) {
		$exists = $wpdb->get_var( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
			$wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type = %s AND post_title = %s LIMIT 1", OKOOL_VACANCY_TYPE, $sample['title'] )
		);

		if ( $exists ) {
			continue;
		}

		wp_insert_post(
			[
				'post_type'    => OKOOL_VACANCY_TYPE,
				'post_status'  => 'publish',
				'post_title'   => $sample['title'],
				'post_excerpt' => $sample['excerpt'],
				'post_content' => $sample['content'],
				// Staggered by an hour so the listing shows them in the design's order.
				'post_date'    => wp_date( 'Y-m-d H:i:s', time() - ( $i + 1 ) * HOUR_IN_SECONDS ),
				'meta_input'   => [
					'_okool_seeded'     => 1,
					'_okool_department' => $sample['department'],
					'_okool_location'   => $sample['location'],
					'_okool_job_type'   => $sample['type'],
					'_okool_ar_title'   => $sample['ar']['title'],
					'_okool_ar_excerpt' => $sample['ar']['excerpt'],
					'_okool_ar_content' => $sample['ar']['content'],
				],
			]
		);
	}
}
add_action( 'init', 'okool_vacancy_seed_samples', 31 );
