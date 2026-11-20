<?php
/**
 * News & Insights: a public post type listed at /news/ with single articles at /news/{slug}/.
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const OKOOL_NEWS_TYPE     = 'okool_news';
const OKOOL_NEWS_PER_PAGE = 9;

/**
 * Register the News post type.
 */
function okool_register_news_type() {
	register_post_type(
		OKOOL_NEWS_TYPE,
		[
			'labels'        => [
				'name'               => __( 'News', 'okool' ),
				'singular_name'      => __( 'News article', 'okool' ),
				'menu_name'          => __( 'News', 'okool' ),
				'add_new'            => __( 'Add article', 'okool' ),
				'add_new_item'       => __( 'Add news article', 'okool' ),
				'edit_item'          => __( 'Edit news article', 'okool' ),
				'new_item'           => __( 'New news article', 'okool' ),
				'view_item'          => __( 'View article', 'okool' ),
				'all_items'          => __( 'All articles', 'okool' ),
				'search_items'       => __( 'Search news', 'okool' ),
				'not_found'          => __( 'No news articles found.', 'okool' ),
				'not_found_in_trash' => __( 'No news articles in Trash.', 'okool' ),
			],
			'public'        => true,
			'show_in_rest'  => true,
			'menu_position' => 20,
			'menu_icon'     => 'dashicons-megaphone',
			'supports'      => [ 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ],
			'has_archive'   => 'news',
			'rewrite'       => [
				'slug'       => 'news',
				'with_front' => false,
			],
		]
	);
}
add_action( 'init', 'okool_register_news_type' );

/**
 * Flush rewrite rules once after the post type is first registered (or its rules change).
 */
function okool_news_flush_rewrites() {
	$version = '1';

	if ( get_option( 'okool_news_rewrite' ) === $version ) {
		return;
	}

	flush_rewrite_rules( false );
	update_option( 'okool_news_rewrite', $version, false );
}
add_action( 'init', 'okool_news_flush_rewrites', 30 );

/**
 * Show a full grid of articles per listing page.
 *
 * @param WP_Query $query Main query.
 */
function okool_news_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_post_type_archive( OKOOL_NEWS_TYPE ) ) {
		$query->set( 'posts_per_page', OKOOL_NEWS_PER_PAGE );
	}
}
add_action( 'pre_get_posts', 'okool_news_query' );

/**
 * Featured image URL for an article, falling back to a brand photo.
 *
 * @param int    $post_id Post ID.
 * @param string $size    Image size.
 * @return string
 */
function okool_news_image( $post_id, $size = 'large' ) {
	$url = get_the_post_thumbnail_url( $post_id, $size );

	return $url ? $url : okool_asset( 'svc-meeting.jpg' );
}

/**
 * The five sample articles, in English with an Arabic version.
 *
 * @return array<int, array{title: string, excerpt: string, content: string, image: string, days: int, ar: array{title: string, excerpt: string, content: string}}>
 */
function okool_news_samples() {
	return [
		[
			'title'   => 'Five questions to ask before outsourcing your workforce',
			'excerpt' => 'Clear scope, compliance responsibilities and reporting lines make the difference between an outsourcing arrangement that runs smoothly and one that needs constant attention.',
			'image'   => 'svc-meeting.jpg',
			'days'    => 3,
			'content' => "<p>Workforce outsourcing can give an organization flexibility, but the value depends on how well the arrangement is defined from the start. Before engaging a provider, it helps to work through a few practical questions.</p>\n<h2>1. Which roles are core, and which are support?</h2>\n<p>Separate the roles that define your service from the roles that keep operations running. Support and project-based roles are usually the best candidates for an outsourced model.</p>\n<h2>2. Who owns compliance?</h2>\n<p>Agree in writing who is responsible for visas, documentation, payroll administration and labour-law compliance, and how that responsibility is evidenced.</p>\n<h2>3. How will performance be measured?</h2>\n<p>Define attendance, turnaround and quality measures up front, along with how often they are reported and reviewed.</p>\n<h2>4. How quickly can the team scale?</h2>\n<p>Ask how replacements are handled and how long it takes to add people during peak periods.</p>\n<h2>5. Who is your single point of contact?</h2>\n<p>One accountable contact keeps escalation simple and avoids gaps between teams.</p>",
			'ar'      => [
				'title'   => 'خمسة أسئلة قبل الاستعانة بمصادر خارجية للقوى العاملة',
				'excerpt' => 'يُحدث وضوح النطاق ومسؤوليات الامتثال وخطوط إعداد التقارير الفرق بين ترتيب استعانة بمصادر خارجية يسير بسلاسة وآخر يحتاج إلى متابعة مستمرة.',
				'content' => "<p>يمكن أن تمنح الاستعانة بمصادر خارجية للقوى العاملة المؤسسةَ مرونة أكبر، لكن قيمتها تعتمد على مدى وضوح الترتيب منذ البداية. وقبل التعاقد مع أي مزوّد خدمة، من المفيد الإجابة عن بعض الأسئلة العملية.</p>\n<h2>1. ما الأدوار الأساسية وما أدوار الدعم؟</h2>\n<p>افصل بين الأدوار التي تحدد طبيعة خدمتك والأدوار التي تحافظ على سير العمليات. وعادةً ما تكون أدوار الدعم والأدوار المرتبطة بالمشاريع الأنسب لنموذج الاستعانة بمصادر خارجية.</p>\n<h2>2. من يتولى مسؤولية الامتثال؟</h2>\n<p>اتفق كتابيًا على الجهة المسؤولة عن التأشيرات والوثائق وإدارة الرواتب والامتثال لقانون العمل، وعلى كيفية إثبات ذلك.</p>\n<h2>3. كيف سيُقاس الأداء؟</h2>\n<p>حدّد مسبقًا مؤشرات الحضور وسرعة الإنجاز والجودة، ومدى تكرار رفع التقارير عنها ومراجعتها.</p>\n<h2>4. ما سرعة توسيع الفريق؟</h2>\n<p>اسأل عن آلية توفير البدلاء والمدة اللازمة لإضافة موظفين خلال فترات الذروة.</p>\n<h2>5. من هو جهة الاتصال الوحيدة؟</h2>\n<p>وجود جهة اتصال واحدة مسؤولة يُبسّط التصعيد ويمنع الثغرات بين الفرق.</p>",
			],
		],
		[
			'title'   => 'Planning preventive maintenance for commercial facilities',
			'excerpt' => 'A structured preventive maintenance plan reduces unplanned downtime, extends asset life and gives facility teams a predictable schedule to work from.',
			'image'   => 'svc-site-team.jpg',
			'days'    => 10,
			'content' => "<p>Reactive maintenance is often more expensive than it first appears. A preventive plan shifts work from emergencies to scheduled visits that can be resourced and supervised properly.</p>\n<h2>Start with an asset register</h2>\n<p>List the systems that keep the building running — HVAC, electrical, plumbing, fire and life safety — with their age, condition and service history.</p>\n<h2>Set frequencies by risk</h2>\n<p>Critical systems need tighter inspection cycles. Lower-risk assets can follow manufacturer guidance or seasonal checks.</p>\n<h2>Report and review</h2>\n<p>Completion reports, defects found and follow-up actions give facility managers a clear view of asset health and help plan budgets for the year ahead.</p>",
			'ar'      => [
				'title'   => 'تخطيط الصيانة الوقائية للمرافق التجارية',
				'excerpt' => 'تُقلّل خطة الصيانة الوقائية المنظّمة من الأعطال غير المخطط لها، وتُطيل عمر الأصول، وتمنح فرق المرافق جدولًا واضحًا يمكن العمل وفقه.',
				'content' => "<p>غالبًا ما تكون الصيانة التفاعلية أعلى تكلفة مما تبدو عليه. أما الخطة الوقائية فتنقل العمل من حالات الطوارئ إلى زيارات مجدولة يمكن تجهيزها والإشراف عليها على النحو الصحيح.</p>\n<h2>ابدأ بسجل الأصول</h2>\n<p>أدرج الأنظمة التي تُبقي المبنى قيد التشغيل — التكييف والكهرباء والسباكة وأنظمة الحريق والسلامة — مع عمرها وحالتها وسجل صيانتها.</p>\n<h2>حدّد التكرار وفق المخاطر</h2>\n<p>تحتاج الأنظمة الحيوية إلى دورات فحص أقصر، بينما يمكن أن تتبع الأصول الأقل خطورة إرشادات الشركة المصنّعة أو الفحوصات الموسمية.</p>\n<h2>التقارير والمراجعة</h2>\n<p>تمنح تقارير الإنجاز والعيوب المكتشفة وإجراءات المتابعة مديري المرافق رؤية واضحة لحالة الأصول، وتساعدهم على تخطيط ميزانية العام المقبل.</p>",
			],
		],
		[
			'title'   => 'What to expect when mobilising a new security team',
			'excerpt' => 'From site surveys to post orders and supervision, a well-planned mobilisation helps a new security team settle into a site quickly and consistently.',
			'image'   => 'svc-security.jpg',
			'days'    => 18,
			'content' => "<p>The first weeks on a new site set the tone for the whole engagement. A structured mobilisation keeps handover risks low and expectations clear.</p>\n<h2>Site survey</h2>\n<p>Access points, patrol routes, CCTV coverage and emergency procedures are reviewed before the team arrives.</p>\n<h2>Post orders and briefings</h2>\n<p>Each post has written instructions covering duties, reporting lines and escalation. Officers are briefed on site-specific requirements before their first shift.</p>\n<h2>Supervision and reporting</h2>\n<p>Supervisors check performance during the early period and incident reporting is set up so the client has visibility from day one.</p>",
			'ar'      => [
				'title'   => 'ما الذي يمكن توقعه عند تجهيز فريق أمن جديد',
				'excerpt' => 'من المسوحات الميدانية إلى تعليمات المواقع والإشراف، يساعد التجهيز المخطط جيدًا فريق الأمن الجديد على الاستقرار في الموقع بسرعة وبأداء ثابت.',
				'content' => "<p>تحدد الأسابيع الأولى في أي موقع جديد طابع التعاقد بأكمله. ويُبقي التجهيز المنظّم مخاطر التسليم منخفضة والتوقعات واضحة.</p>\n<h2>المسح الميداني</h2>\n<p>تُراجَع نقاط الدخول ومسارات الدوريات وتغطية كاميرات المراقبة وإجراءات الطوارئ قبل وصول الفريق.</p>\n<h2>تعليمات المواقع والإحاطات</h2>\n<p>لكل موقع تعليمات مكتوبة تغطي المهام وخطوط الإبلاغ والتصعيد، ويُطلَع أفراد الأمن على متطلبات الموقع قبل نوبتهم الأولى.</p>\n<h2>الإشراف وإعداد التقارير</h2>\n<p>يتابع المشرفون الأداء خلال الفترة الأولى، ويُعَدّ نظام الإبلاغ عن الحوادث ليحظى العميل برؤية واضحة منذ اليوم الأول.</p>",
			],
		],
		[
			'title'   => 'Building a national talent pipeline through Emiratisation',
			'excerpt' => 'Emiratisation works best as a long-term talent strategy: clear career paths, structured onboarding and development plans that help UAE nationals build lasting careers.',
			'image'   => 'about-intro.jpg',
			'days'    => 27,
			'content' => "<p>Organizations that treat Emiratisation as a talent strategy rather than a target tend to see better retention and stronger teams.</p>\n<h2>Define meaningful roles</h2>\n<p>Identify positions with clear responsibilities and progression, and match them to candidates' skills and interests.</p>\n<h2>Structured onboarding</h2>\n<p>A defined onboarding plan, mentoring and regular check-ins help new joiners settle in and contribute sooner.</p>\n<h2>Development plans</h2>\n<p>Training, rotations and agreed milestones turn a first role into a long-term career path.</p>",
			'ar'      => [
				'title'   => 'بناء قاعدة من الكفاءات الوطنية من خلال التوطين',
				'excerpt' => 'ينجح التوطين عندما يكون استراتيجية طويلة الأمد للمواهب: مسارات مهنية واضحة، وتهيئة منظّمة، وخطط تطوير تساعد المواطنين الإماراتيين على بناء مسيرات مهنية مستدامة.',
				'content' => "<p>المؤسسات التي تتعامل مع التوطين بوصفه استراتيجية للمواهب لا مجرد هدف رقمي تحقق عادةً معدلات احتفاظ أعلى وفرقًا أقوى.</p>\n<h2>حدّد أدوارًا ذات قيمة</h2>\n<p>حدّد الوظائف ذات المسؤوليات الواضحة وفرص التقدّم، وطابقها مع مهارات المرشحين واهتماماتهم.</p>\n<h2>تهيئة منظّمة</h2>\n<p>تساعد خطة التهيئة الواضحة والإرشاد والمتابعة المنتظمة الموظفين الجدد على الاندماج والمساهمة بشكل أسرع.</p>\n<h2>خطط التطوير</h2>\n<p>يحوّل التدريب والتنقل بين الأدوار والمراحل المتفق عليها الوظيفةَ الأولى إلى مسار مهني طويل الأمد.</p>",
			],
		],
		[
			'title'   => 'Health and safety essentials for on-site service teams',
			'excerpt' => 'Clear risk assessments, the right protective equipment and simple reporting habits help on-site teams work safely and keep facilities running without disruption.',
			'image'   => 'about-hse.jpg',
			'days'    => 35,
			'content' => "<p>On-site teams work around live equipment, public areas and changing conditions. Good health and safety practice protects people and keeps service delivery on schedule.</p>\n<h2>Assess the risks before the work starts</h2>\n<p>Each task should have a risk assessment that identifies hazards, the controls in place and who is responsible for them.</p>\n<h2>Provide and check protective equipment</h2>\n<p>Personal protective equipment should match the task and be inspected regularly, with replacements available on site.</p>\n<h2>Make reporting easy</h2>\n<p>Near misses and incidents are easier to prevent when reporting is simple. Supervisors review reports, share lessons and update procedures.</p>\n<h2>Train and refresh</h2>\n<p>Induction training, toolbox talks and periodic refreshers keep safety expectations clear for new and existing team members.</p>",
			'ar'      => [
				'title'   => 'أساسيات الصحة والسلامة لفرق الخدمات الميدانية',
				'excerpt' => 'يساعد تقييم المخاطر بوضوح، ومعدات الوقاية المناسبة، وعادات الإبلاغ البسيطة الفرقَ الميدانية على العمل بأمان والحفاظ على تشغيل المرافق دون انقطاع.',
				'content' => "<p>تعمل الفرق الميدانية بالقرب من معدات قيد التشغيل ومناطق عامة وظروف متغيرة. وتحمي الممارسات الجيدة في مجال الصحة والسلامة الأفراد، وتحافظ على تقديم الخدمات في مواعيدها.</p>\n<h2>قيّم المخاطر قبل بدء العمل</h2>\n<p>ينبغي أن يكون لكل مهمة تقييم للمخاطر يحدد المخاطر المحتملة وإجراءات التحكم المطبّقة والمسؤولين عنها.</p>\n<h2>وفّر معدات الوقاية وافحصها</h2>\n<p>يجب أن تتناسب معدات الوقاية الشخصية مع طبيعة المهمة، وأن تُفحص بانتظام، مع توفّر بدائل في الموقع.</p>\n<h2>سهّل الإبلاغ</h2>\n<p>يصبح منع الحوادث أسهل عندما يكون الإبلاغ عن الحوادث الوشيكة والفعلية بسيطًا. ويراجع المشرفون البلاغات، ويشاركون الدروس المستفادة، ويحدّثون الإجراءات.</p>\n<h2>درّب وجدّد المعرفة</h2>\n<p>يُبقي التدريب التعريفي، والإحاطات الميدانية القصيرة، والدورات التنشيطية الدورية توقعات السلامة واضحة للموظفين الجدد والحاليين.</p>",
			],
		],
	];
}

/**
 * Copy a plugin image into the media library, attached to an article.
 *
 * @param string $file    File name under assets/.
 * @param int    $post_id Article ID.
 * @return int Attachment ID, or 0 on failure.
 */
function okool_news_import_image( $file, $post_id ) {
	$path = OKOOL_DIR . 'assets/' . $file;

	if ( ! file_exists( $path ) ) {
		return 0;
	}

	$upload = wp_upload_bits( 'okool-news-' . $file, null, file_get_contents( $path ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- local plugin file.

	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}

	$type          = wp_check_filetype( $upload['file'] );
	$attachment_id = wp_insert_attachment(
		[
			'post_mime_type' => $type['type'] ? $type['type'] : 'image/jpeg',
			'post_title'     => get_the_title( $post_id ),
			'post_status'    => 'inherit',
		],
		$upload['file'],
		$post_id
	);

	if ( is_wp_error( $attachment_id ) || ! $attachment_id ) {
		return 0;
	}

	require_once ABSPATH . 'wp-admin/includes/image.php';
	wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $upload['file'] ) );

	return (int) $attachment_id;
}

/**
 * Add the five sample articles exactly once.
 *
 * - The once-only marker is claimed with a single atomic database insert, so simultaneous
 *   page loads cannot both add samples, and caching cannot make it run again.
 * - A sample is skipped if an article with the same title already exists.
 * - Deleting the samples later does not bring them back.
 */
function okool_news_seed_samples() {
	global $wpdb;

	$marker = 'okool_news_samples_v2';

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

	foreach ( okool_news_samples() as $sample ) {
		$exists = $wpdb->get_var( // phpcs:ignore WordPress.DB.DirectDatabaseQuery
			$wpdb->prepare(
				"SELECT ID FROM {$wpdb->posts} WHERE post_type = %s AND post_title = %s LIMIT 1",
				OKOOL_NEWS_TYPE,
				$sample['title']
			)
		);

		if ( $exists ) {
			continue;
		}

		$post_id = wp_insert_post(
			[
				'post_type'    => OKOOL_NEWS_TYPE,
				'post_status'  => 'publish',
				'post_title'   => $sample['title'],
				'post_excerpt' => $sample['excerpt'],
				'post_content' => $sample['content'],
				'post_date'    => wp_date( 'Y-m-d H:i:s', time() - $sample['days'] * DAY_IN_SECONDS ),
				'meta_input'   => [
					'_okool_sample'     => 1,
					'_okool_ar_title'   => $sample['ar']['title'],
					'_okool_ar_excerpt' => $sample['ar']['excerpt'],
					'_okool_ar_content' => $sample['ar']['content'],
				],
			],
			true
		);

		if ( is_wp_error( $post_id ) ) {
			continue;
		}

		$image_id = okool_news_import_image( $sample['image'], $post_id );

		if ( $image_id ) {
			set_post_thumbnail( $post_id, $image_id );
		}
	}
}
add_action( 'init', 'okool_news_seed_samples', 31 );

/**
 * "Delete all news" screen under the News menu.
 */
function okool_news_delete_all_menu() {
	add_submenu_page(
		'edit.php?post_type=' . OKOOL_NEWS_TYPE,
		__( 'Delete all news', 'okool' ),
		__( 'Delete all news', 'okool' ),
		'manage_options',
		'okool-news-delete-all',
		'okool_news_delete_all_screen'
	);
}
add_action( 'admin_menu', 'okool_news_delete_all_menu' );

/**
 * IDs of every news article, in any status (trash and drafts included).
 *
 * @return int[]
 */
function okool_news_all_ids() {
	return array_map(
		'intval',
		get_posts(
			[
				'post_type'      => OKOOL_NEWS_TYPE,
				'post_status'    => 'any,trash,auto-draft',
				'posts_per_page' => -1,
				'fields'         => 'ids',
			]
		)
	);
}

/**
 * Render the "Delete all news" screen.
 */
function okool_news_delete_all_screen() {
	$count   = count( okool_news_all_ids() );
	$deleted = isset( $_GET['deleted'] ) ? absint( $_GET['deleted'] ) : null; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display only.
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Delete all news', 'okool' ); ?></h1>

		<?php if ( null !== $deleted ) : ?>
			<div class="notice notice-success"><p>
				<?php
				/* translators: %d: number of deleted articles. */
				echo esc_html( sprintf( _n( '%d article was deleted.', '%d articles were deleted.', $deleted, 'okool' ), $deleted ) );
				?>
			</p></div>
		<?php endif; ?>

		<p>
			<?php
			/* translators: %d: number of articles. */
			echo esc_html( sprintf( _n( 'There is %d news article (including drafts and trash).', 'There are %d news articles (including drafts and trash).', $count, 'okool' ), $count ) );
			?>
		</p>
		<p><?php esc_html_e( 'This permanently deletes every news article, its Arabic version and the featured images uploaded with it. It cannot be undone.', 'okool' ); ?></p>

		<?php if ( $count ) : ?>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" onsubmit="return confirm('<?php echo esc_js( __( 'Permanently delete all news articles?', 'okool' ) ); ?>');">
				<input type="hidden" name="action" value="okool_news_delete_all">
				<?php wp_nonce_field( 'okool_news_delete_all' ); ?>
				<?php submit_button( __( 'Delete all news articles', 'okool' ), 'delete' ); ?>
			</form>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Permanently delete every news article and the featured images attached to them.
 */
function okool_news_delete_all() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You are not allowed to do this.', 'okool' ), 403 );
	}

	check_admin_referer( 'okool_news_delete_all' );

	$deleted = 0;

	foreach ( okool_news_all_ids() as $post_id ) {
		$thumb_id = (int) get_post_thumbnail_id( $post_id );

		// Only remove images that were uploaded to this article, never shared media.
		if ( $thumb_id && (int) get_post_field( 'post_parent', $thumb_id ) === $post_id ) {
			wp_delete_attachment( $thumb_id, true );
		}

		if ( wp_delete_post( $post_id, true ) ) {
			++$deleted;
		}
	}

	wp_safe_redirect( admin_url( 'edit.php?post_type=' . OKOOL_NEWS_TYPE . '&page=okool-news-delete-all&deleted=' . $deleted ) );
	exit;
}
add_action( 'admin_post_okool_news_delete_all', 'okool_news_delete_all' );

/**
 * Arabic article fields: key => [ meta key, admin label ].
 *
 * @return array<string, array{meta: string, label: string}>
 */
function okool_news_ar_fields() {
	return [
		'title'   => [
			'meta'  => '_okool_ar_title',
			'label' => __( 'Arabic title', 'okool' ),
		],
		'excerpt' => [
			'meta'  => '_okool_ar_excerpt',
			'label' => __( 'Arabic summary', 'okool' ),
		],
		'content' => [
			'meta'  => '_okool_ar_content',
			'label' => __( 'Arabic article text', 'okool' ),
		],
	];
}

/**
 * Post types that have an "Arabic version" box (News, plus any added through the filter).
 *
 * @return string[]
 */
function okool_ar_post_types() {
	return (array) apply_filters( 'okool_ar_post_types', [ OKOOL_NEWS_TYPE ] );
}

/**
 * Arabic value of an article field on Arabic pages, or an empty string.
 *
 * @param int    $post_id Post ID.
 * @param string $key     title, excerpt or content.
 * @return string
 */
function okool_news_ar( $post_id, $key ) {
	if ( ! $post_id || ! okool_is_ar() || ! in_array( get_post_type( $post_id ), okool_ar_post_types(), true ) ) {
		return '';
	}

	return (string) get_post_meta( $post_id, okool_news_ar_fields()[ $key ]['meta'], true );
}

/**
 * "Arabic version" box on the article screen.
 */
function okool_news_ar_meta_box() {
	add_meta_box(
		'okool-news-ar',
		__( 'Arabic version', 'okool' ),
		static function ( $post ) {
			$fields = okool_news_ar_fields();
			wp_nonce_field( 'okool_news_ar', '_okool_news_ar_nonce' );

			echo '<p>' . esc_html__( 'Shown when visitors switch the site to Arabic. Leave a field empty to show the English text instead.', 'okool' ) . '</p>';

			printf(
				'<p><label for="okool-ar-title"><strong>%1$s</strong></label><br><input type="text" id="okool-ar-title" name="okool_ar[title]" value="%2$s" dir="rtl" lang="ar" class="widefat"></p>',
				esc_html( $fields['title']['label'] ),
				esc_attr( get_post_meta( $post->ID, $fields['title']['meta'], true ) )
			);
			printf(
				'<p><label for="okool-ar-excerpt"><strong>%1$s</strong></label><br><textarea id="okool-ar-excerpt" name="okool_ar[excerpt]" rows="3" dir="rtl" lang="ar" class="widefat">%2$s</textarea></p>',
				esc_html( $fields['excerpt']['label'] ),
				esc_textarea( get_post_meta( $post->ID, $fields['excerpt']['meta'], true ) )
			);
			echo '<p><strong>' . esc_html( $fields['content']['label'] ) . '</strong></p>';
			wp_editor(
				(string) get_post_meta( $post->ID, $fields['content']['meta'], true ),
				'okool_ar_content',
				[
					'textarea_name' => 'okool_ar[content]',
					'textarea_rows' => 14,
					'media_buttons' => false,
				]
			);
		},
		okool_ar_post_types(),
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'okool_news_ar_meta_box' );

/**
 * Save the Arabic version.
 *
 * @param int $post_id Post ID.
 */
function okool_news_save_ar( $post_id ) {
	if (
		( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		|| ! isset( $_POST['_okool_news_ar_nonce'], $_POST['okool_ar'] )
		|| ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['_okool_news_ar_nonce'] ) ), 'okool_news_ar' )
		|| ! current_user_can( 'edit_post', $post_id )
	) {
		return;
	}

	$input = wp_unslash( $_POST['okool_ar'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitized per field below.
	$input = is_array( $input ) ? $input : [];

	$values = [
		'title'   => sanitize_text_field( isset( $input['title'] ) ? $input['title'] : '' ),
		'excerpt' => sanitize_textarea_field( isset( $input['excerpt'] ) ? $input['excerpt'] : '' ),
		'content' => wp_kses_post( isset( $input['content'] ) ? $input['content'] : '' ),
	];

	foreach ( okool_news_ar_fields() as $key => $field ) {
		if ( '' === trim( $values[ $key ] ) ) {
			delete_post_meta( $post_id, $field['meta'] );
		} else {
			update_post_meta( $post_id, $field['meta'], wp_slash( $values[ $key ] ) );
		}
	}
}
/**
 * Hook the Arabic save handler for every post type with an Arabic version.
 */
function okool_ar_register_save() {
	foreach ( okool_ar_post_types() as $type ) {
		add_action( 'save_post_' . $type, 'okool_news_save_ar' );
	}
}
add_action( 'init', 'okool_ar_register_save', 40 );

/**
 * Arabic article title.
 *
 * @param string $title   Title.
 * @param int    $post_id Post ID.
 * @return string
 */
function okool_news_ar_title( $title, $post_id = 0 ) {
	$ar = okool_news_ar( (int) $post_id, 'title' );

	return '' !== $ar ? $ar : $title;
}
add_filter( 'the_title', 'okool_news_ar_title', 10, 2 );

/**
 * Arabic article title in the browser tab.
 *
 * @param string       $title Title.
 * @param WP_Post|null $post  Post.
 * @return string
 */
function okool_news_ar_single_title( $title, $post = null ) {
	return okool_news_ar_title( $title, $post ? $post->ID : 0 );
}
add_filter( 'single_post_title', 'okool_news_ar_single_title', 10, 2 );

/**
 * Arabic article summary.
 *
 * @param string       $excerpt Excerpt.
 * @param WP_Post|null $post    Post.
 * @return string
 */
function okool_news_ar_excerpt( $excerpt, $post = null ) {
	$ar = okool_news_ar( $post ? $post->ID : 0, 'excerpt' );

	return '' !== $ar ? $ar : $excerpt;
}
add_filter( 'get_the_excerpt', 'okool_news_ar_excerpt', 20, 2 );

/**
 * Arabic article body. Runs before the usual content filters so it is formatted the same way.
 *
 * @param string $content Content.
 * @return string
 */
function okool_news_ar_content( $content ) {
	$ar = in_the_loop() ? okool_news_ar( (int) get_the_ID(), 'content' ) : '';

	return '' !== $ar ? $ar : $content;
}
add_filter( 'the_content', 'okool_news_ar_content', 1 );
