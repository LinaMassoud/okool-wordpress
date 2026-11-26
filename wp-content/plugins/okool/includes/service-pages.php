<?php
/**
 * Service detail pages under /services/ (Figma 625:4073, 625:6967, 625:5842).
 *
 * Each page shares templates/parts/service-detail.php; its content lives here.
 *
 * @package Okool
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Service detail pages, keyed by design name.
 *
 * @return array<string, array<string, mixed>>
 */
function okool_service_pages() {
	return [
		'service-workforce'     => [
			'slug'    => 'workforce-solutions',
			'title'   => __( 'Workforce Solutions', 'okool' ),
			'heading' => __( 'Workforce Solutions in the UAE', 'okool' ),
			'intro'   => __( 'Build and manage the workforce your organization needs to operate and grow. OKOOL supports professional, technical, skilled and support roles through talent acquisition, workforce outsourcing and workforce management solutions.', 'okool' ),
			'image'   => 'svd-workforce-hero.jpg',
			'alt'     => __( 'Team meeting with Emirati and international professionals', 'okool' ),
			'cards'   => [
				[ 'svc-search', __( 'Recruitment and talent acquisition', 'okool' ), __( 'Identify candidates whose experience and capabilities align with your roles, from requirement understanding to selection support.', 'okool' ) ],
				[ 'svc-people', __( 'Flexible workforce support', 'okool' ), __( 'Permanent recruitment, contract staffing, professional outsourcing, skilled workforce supply, project-based hiring and large-scale mobilisation.', 'okool' ) ],
				[ 'svc-clipboard', __( 'Workforce administration', 'okool' ), __( 'Onboarding, payroll administration, employee lifecycle management, visa and documentation processes, compliance and site-based support.', 'okool' ) ],
			],
			'links'   => [
				[ __( 'Talent Acquisition & Recruitment', 'okool' ), 'service-talent' ],
				[ __( 'Workforce Outsourcing', 'okool' ), 'service-outsourcing' ],
				[ __( 'Emiratisation & National Talent', 'okool' ), 'service-emiratisation' ],
			],
			'faqs'    => [
				[ __( 'What workforce solutions does OKOOL provide in the UAE?', 'okool' ), __( 'OKOOL provides talent acquisition, recruitment, workforce outsourcing, contract staffing, Emiratisation support, and workforce administration solutions tailored to business needs.', 'okool' ) ],
				[ __( 'Does OKOOL offer temporary and permanent staffing solutions?', 'okool' ), __( 'Yes. OKOOL supports permanent recruitment, contract staffing, skilled workforce supply, and project-based hiring to help businesses meet their operational requirements.', 'okool' ) ],
				[ __( 'How does OKOOL support Emiratisation and UAE national recruitment?', 'okool' ), __( 'OKOOL helps businesses identify and recruit qualified UAE nationals, supporting their Emiratisation objectives and long-term workforce requirements.', 'okool' ) ],
			],
			'related' => [ 'facilities', 'security' ],
		],
		'service-talent'        => [
			'slug'           => 'talent-acquisition-recruitment',
			'title'          => __( 'Talent Acquisition & Recruitment', 'okool' ),
			'heading'        => __( 'Talent Acquisition & Recruitment in the UAE', 'okool' ),
			'intro'          => __( 'Recruit people whose skills and experience align with your organization’s needs. OKOOL supports candidate identification, assessment and selection.', 'okool' ),
			'image'          => 'svd-talent-hero.jpg',
			'image_position' => '21% center',
			'alt'            => __( 'Recruiter interviewing a candidate', 'okool' ),
			'lead'           => [ __( 'Recruitment shaped around the role', 'okool' ), __( 'Permanent recruitment, contract staffing and project-based hiring across professional, technical, skilled and support roles.', 'okool' ) ],
			'process'        => [
				__( 'Our recruitment process', 'okool' ),
				[ __( 'Requirement understanding', 'okool' ), __( 'Role definition', 'okool' ), __( 'Candidate sourcing', 'okool' ), __( 'Screening and assessment', 'okool' ), __( 'Shortlisting', 'okool' ), __( 'Selection support.', 'okool' ) ],
			],
			'checklist'      => [
				__( 'What to include in your enquiry', 'okool' ),
				[ __( 'Share role descriptions', 'okool' ), __( 'required experience and qualifications', 'okool' ), __( 'number of vacancies', 'okool' ), __( 'location', 'okool' ), __( 'and expected hiring timeline.', 'okool' ) ],
			],
			'faqs'           => [
				[ __( 'What talent acquisition and recruitment services does OKOOL provide in the UAE?', 'okool' ), __( 'OKOOL provides permanent recruitment, contract staffing, and project-based hiring for professional, technical, skilled, and support roles across the UAE.', 'okool' ) ],
				[ __( 'How does OKOOL’s recruitment process work?', 'okool' ), __( 'Our recruitment process includes understanding your requirements, defining roles, sourcing candidates, screening and assessment, shortlisting, and supporting the final selection.', 'okool' ) ],
				[ __( 'Can OKOOL help businesses recruit candidates for specialized or technical roles?', 'okool' ), __( 'Yes. OKOOL supports recruitment for professional, technical, and skilled positions, helping businesses identify candidates whose qualifications and experience align with their specific requirements.', 'okool' ) ],
			],
			'related'        => [ 'facilities', 'security' ],
		],
		'service-outsourcing'   => [
			'slug'       => 'workforce-outsourcing',
			'title'      => __( 'Workforce Outsourcing', 'okool' ),
			'heading'    => __( 'Workforce Outsourcing & Employee Administration in the UAE', 'okool' ),
			'intro'      => __( 'Keep your attention on core operations while OKOOL supports workforce administration and employment processes.', 'okool' ),
			'image'      => 'svd-related-workforce.jpg',
			'alt'        => __( 'Team reviewing plans around a meeting table', 'okool' ),
			'tiles'      => [
				__( 'Our workforce outsourcing capabilities', 'okool' ),
				[
					[ 'svc-people', __( 'Mobilisation and onboarding', 'okool' ) ],
					[ 'svc-document', __( 'visa and documentation', 'okool' ) ],
					[ 'svc-payroll', __( 'payroll and lifecycle management', 'okool' ) ],
					[ 'svc-clipboard', __( 'compliance and attendance', 'okool' ) ],
					[ 'svc-building', __( 'site support', 'okool' ) ],
					[ 'svc-exit', __( 'offboarding.', 'okool' ) ],
				],
			],
			'note'       => [ __( 'Support for changing workforce needs', 'okool' ), __( 'Flexible capacity, reduced administrative workload, structured employee management and centralized support.', 'okool' ) ],
			'note_style' => 'glass',
			'faqs'       => [
				[ __( 'What workforce outsourcing and employee administration services does OKOOL provide in the UAE?', 'okool' ), __( 'OKOOL provides workforce mobilisation, onboarding, visa and documentation support, payroll administration, employee lifecycle management, attendance tracking, compliance coordination, and offboarding services.', 'okool' ) ],
				[ __( 'How can workforce outsourcing benefit businesses in the UAE?', 'okool' ), __( 'Workforce outsourcing helps businesses reduce administrative workloads, manage changing staffing requirements, and maintain structured employee management while focusing on their core operations.', 'okool' ) ],
				[ __( 'Can OKOOL support businesses with changing workforce requirements?', 'okool' ), __( 'Yes. OKOOL offers flexible workforce support to help businesses manage changing staffing needs, coordinate employee mobilisation, and maintain consistent workforce administration across their operations.', 'okool' ) ],
			],
			'related'    => [ 'facilities', 'security' ],
		],
		'service-facilities'    => [
			'slug'        => 'facilities-management',
			'title'       => __( 'Facilities Management', 'okool' ),
			'heading'     => __( 'Facilities Management Services in the UAE', 'okool' ),
			'intro'       => __( 'Support reliable building operations, asset performance and workplace standards with facilities management services designed around your site.', 'okool' ),
			'image'       => 'svd-hardfm-hero.jpg',
			'alt'         => __( 'Technician servicing an electrical panel', 'okool' ),
			'card_layout' => 'two',
			'cards'       => [
				[ 'svc-wrench', __( 'Hard Facilities Management', 'okool' ), __( 'HVAC, mechanical, electrical and plumbing services with preventive and corrective maintenance.', 'okool' ) ],
				[ 'svc-sparkle', __( 'Soft Facilities Management', 'okool' ), __( 'Cleaning, housekeeping, hygiene, pest control, landscaping and workplace support personnel.', 'okool' ) ],
			],
			'links'       => [
				[ __( 'Hard FM', 'okool' ), 'service-hard-fm' ],
				[ __( 'Soft FM', 'okool' ), 'service-soft-fm' ],
			],
			'faqs'        => [
				[ __( 'What facilities management services does OKOOL provide in the UAE?', 'okool' ), __( 'OKOOL provides Hard and Soft Facilities Management services, including HVAC, mechanical, electrical and plumbing maintenance, cleaning, housekeeping, pest control, landscaping, and workplace support.', 'okool' ) ],
				[ __( 'What is the difference between Hard and Soft Facilities Management services?', 'okool' ), __( 'Hard Facilities Management focuses on maintaining building systems and infrastructure, such as HVAC, electrical, mechanical, and plumbing systems. Soft Facilities Management covers cleaning, hygiene, landscaping, and other services that support a safe and well-maintained workplace.', 'okool' ) ],
				[ __( 'Does OKOOL provide preventive and corrective maintenance services?', 'okool' ), __( 'Yes. OKOOL provides preventive and corrective maintenance for essential building systems, helping businesses maintain operational reliability, address technical issues, and support the long-term performance of their facilities.', 'okool' ) ],
			],
			'related'     => [ 'workforce', 'security' ],
		],
		'service-hard-fm'       => [
			'slug'    => 'hard-facilities-management',
			'title'   => __( 'Hard Facilities Management', 'okool' ),
			'heading' => __( 'Hard Facilities Management & Technical Maintenance', 'okool' ),
			'intro'   => __( 'Support the reliability and performance of technical systems and building assets across commercial, institutional and industrial facilities.', 'okool' ),
			'image'   => 'svd-hardfm-hero.jpg',
			'alt'     => __( 'Technician servicing an electrical panel', 'okool' ),
			'cards'   => [
				[ 'svc-hvac', __( 'HVAC operations and maintenance', 'okool' ), __( 'Inspection, preventive and corrective maintenance, performance monitoring and equipment maintenance.', 'okool' ) ],
				[ 'svc-wrench', __( 'Mechanical and electrical systems', 'okool' ), __( 'Pumps, hydraulic systems, boilers, cooling and water systems, power, lighting, equipment and controls.', 'okool' ) ],
				[ 'svc-building', __( 'Building, plumbing and asset support', 'okool' ), __( 'Building and asset maintenance, technical inspections and equipment performance monitoring.', 'okool' ) ],
			],
			'faqs'    => [
				[ __( 'What Hard Facilities Management services does OKOOL provide in the UAE?', 'okool' ), __( 'OKOOL provides HVAC maintenance, mechanical and electrical system support, plumbing services, technical inspections, and building asset maintenance for commercial, institutional, and industrial facilities.', 'okool' ) ],
				[ __( 'Does OKOOL offer preventive and corrective maintenance for building systems?', 'okool' ), __( 'Yes. OKOOL provides preventive and corrective maintenance services for HVAC, mechanical, electrical, and plumbing systems to help minimize equipment downtime, maintain operational efficiency, and improve asset reliability.', 'okool' ) ],
				[ __( 'How can OKOOL help businesses improve building performance and asset reliability?', 'okool' ), __( 'OKOOL supports building performance through regular inspections, equipment monitoring, planned maintenance, and technical support, helping businesses identify potential issues early and maintain reliable facility operations.', 'okool' ) ],
			],
			'related' => [ 'workforce', 'security' ],
		],
		'service-soft-fm'       => [
			'slug'        => 'soft-facilities-management',
			'title'       => __( 'Soft Facilities Management', 'okool' ),
			'heading'     => __( 'Soft Facilities Management & Workplace Support', 'okool' ),
			'intro'       => __( 'Create cleaner, well-maintained and organized facilities with soft FM services tailored to your workplace.', 'okool' ),
			'image'       => 'svd-hardfm-hero.jpg',
			'alt'         => __( 'Facilities technician at work on site', 'okool' ),
			'card_layout' => 'rows',
			'cards'       => [
				[ 'svc-sparkle', __( 'Cleaning and housekeeping', 'okool' ), __( 'General and office cleaning, housekeeping, carpet cleaning, floor and marble care and facade cleaning.', 'okool' ) ],
				[ 'svc-leaf', __( 'Hygiene and outdoor support', 'okool' ), __( 'Sanitation, pest control, waste management and landscaping according to agreed scope.', 'okool' ) ],
				[ 'svc-bell', __( 'Workplace and hospitality support', 'okool' ), __( 'Hospitality, office support and internal logistics personnel selected around your requirements.', 'okool' ) ],
			],
			'faqs'        => [
				[ __( 'What Soft Facilities Management services does OKOOL provide in the UAE?', 'okool' ), __( 'OKOOL provides cleaning, housekeeping, carpet and floor care, facade cleaning, sanitation, pest control, waste management, landscaping, and workplace support services tailored to business requirements.', 'okool' ) ],
				[ __( 'Can OKOOL customize Soft Facilities Management services for different workplaces?', 'okool' ), __( 'Yes. OKOOL offers flexible Soft FM solutions based on each facility’s size, operational needs, and service requirements, helping businesses maintain clean, organized, and well-managed workplaces.', 'okool' ) ],
				[ __( 'Does OKOOL provide hospitality and workplace support personnel?', 'okool' ), __( 'Yes. OKOOL provides hospitality, office support, and internal logistics personnel to assist with daily workplace operations and help organizations maintain an efficient and professional working environment.', 'okool' ) ],
			],
			'related'     => [ 'workforce', 'security' ],
		],
		'service-security'      => [
			'slug'       => 'security-services',
			'title'      => __( 'Security Services', 'okool' ),
			'heading'    => __( 'Security Services for People, Facilities & Operations', 'okool' ),
			'intro'      => __( 'Professional security personnel, site supervision and structured operating procedures within approved licensing and operational scope.', 'okool' ),
			'image'      => 'svd-security-hero.jpg',
			'alt'        => __( 'Security officer in a CCTV control room', 'okool' ),
			'tiles'      => [
				__( 'Our security capabilities', 'okool' ),
				[
					[ 'svc-shield', __( 'Manned guarding and access control', 'okool' ) ],
					[ 'svc-target', __( 'patrolling and incident reporting', 'okool' ) ],
					[ 'svc-reception', __( 'reception security', 'okool' ) ],
					[ 'svc-home', __( 'site and asset protection', 'okool' ) ],
					[ 'svc-calendar', __( 'event security', 'okool' ) ],
					[ 'svc-headset', __( 'supervision and control-room support.', 'okool' ) ],
				],
			],
			'note'       => [ __( 'Structured support at site level', 'okool' ), __( 'Personnel deployment, supervision and operating procedures aligned with agreed site requirements.', 'okool' ) ],
			'note_style' => 'glass',
			'faqs'       => [
				[ __( 'What security services does OKOOL provide in the UAE?', 'okool' ), __( 'OKOOL provides manned guarding, access control, security patrolling, incident reporting, reception security, site and asset protection, event security, and control-room support within approved licensing and operational requirements.', 'okool' ) ],
				[ __( 'Can OKOOL provide security personnel for commercial facilities and events?', 'okool' ), __( 'Yes. OKOOL supports businesses and event organizers with security personnel, site supervision, access control, and structured security procedures tailored to their operational needs and site requirements.', 'okool' ) ],
				[ __( 'How does OKOOL ensure effective security management and site protection?', 'okool' ), __( 'OKOOL supports effective security operations through personnel deployment, site supervision, regular patrolling, incident reporting, and established operating procedures aligned with each facility’s security requirements.', 'okool' ) ],
			],
			'related'    => [ 'workforce', 'facilities' ],
		],
		'service-emiratisation' => [
			'slug'          => 'emiratisation-national-talent',
			'title'         => __( 'Emiratisation & National Talent', 'okool' ),
			'heading'       => __( 'Emiratisation & National Talent Solutions', 'okool' ),
			'intro'         => __( 'Connect your workforce requirements with long-term national talent objectives through structured sourcing, hiring and development solutions.', 'okool' ),
			'image'         => 'svd-emiratisation-hero.jpg',
			'alt'           => __( 'Emirati professional leading a boardroom meeting', 'okool' ),
			'section_title' => __( 'Our capabilities', 'okool' ),
			'cards'         => [
				[ 'svc-search', __( 'Attract & hire', 'okool' ), [ __( 'Emirati talent sourcing', 'okool' ), __( 'screening and placement', 'okool' ), __( 'employer branding', 'okool' ) ] ],
				[ 'svc-people', __( 'Develop talent', 'okool' ), [ __( 'graduate programmes', 'okool' ), __( 'development and upskilling', 'okool' ) ] ],
				[ 'svc-clipboard', __( 'Plan & retain', 'okool' ), [ __( 'workforce planning', 'okool' ), __( 'engagement and retention.', 'okool' ) ] ],
			],
			'note'          => [ __( 'A workforce approach with long-term focus', 'okool' ), __( 'We align talent requirements with suitable Emirati candidates while supporting planning, development and engagement needs.', 'okool' ) ],
			'faqs'          => [
				[ __( 'What Emiratisation and national talent solutions does OKOOL provide in the UAE?', 'okool' ), __( 'OKOOL supports businesses with Emirati talent sourcing, recruitment, screening, placement, graduate programmes, workforce planning, and employee development to help achieve their long-term Emiratisation objectives.', 'okool' ) ],
				[ __( 'How can OKOOL help companies achieve their Emiratisation goals?', 'okool' ), __( 'OKOOL helps organizations identify qualified UAE nationals, align recruitment strategies with workforce requirements, and support talent development and retention through structured Emiratisation solutions.', 'okool' ) ],
				[ __( 'Does OKOOL provide training and career development support for Emirati employees?', 'okool' ), __( 'Yes. OKOOL supports graduate programmes, employee development, upskilling, and engagement initiatives to help businesses develop Emirati talent and improve long-term workforce retention.', 'okool' ) ],
			],
			'related'       => [ 'facilities', 'security' ],
		],
	];
}

/**
 * Cards for the "Related Services" section.
 *
 * @return array<string, array{title: string, text: string, image: string, url: string}>
 */
function okool_related_services() {
	$services = okool_page_url( 'services', home_url( '/' ) );

	return [
		'workforce'  => [
			'title' => __( 'Workforce Solutions', 'okool' ),
			'text'  => __( 'Connect your organization with professional, technical, skilled and support talent—from recruitment to outsourcing and employee administration.', 'okool' ),
			'image' => 'svd-related-workforce.jpg',
			'url'   => okool_page_url( 'service-workforce', $services . '#workforce' ),
		],
		'facilities' => [
			'title' => __( 'Facilities Management', 'okool' ),
			'text'  => __( 'Support facility performance through technical maintenance, cleaning, housekeeping and workplace support.', 'okool' ),
			'image' => 'svd-hardfm-hero.jpg',
			'url'   => okool_page_url( 'service-facilities', $services . '#facilities' ),
		],
		'security'   => [
			'title' => __( 'Security Services', 'okool' ),
			'text'  => __( 'Protect people, facilities and operations with professional personnel and structured procedures within approved scope.', 'okool' ),
			'image' => 'svd-related-security.jpg',
			'url'   => okool_page_url( 'service-security', $services . '#security' ),
		],
	];
}

/**
 * Publish the service detail pages once, as children of the Services page.
 */
function okool_ensure_service_pages() {
	foreach ( okool_service_pages() as $design => $page ) {
		okool_ensure_page( $design, $page['title'], $page['slug'], 'services' );
	}
}
add_action( 'init', 'okool_ensure_service_pages', 22 );
