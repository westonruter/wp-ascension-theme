<?php

/**
 * Load custom template tags for this theme.
 *
 * @since 1.0.0
 */
require_once get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Remove titles from templates.
 *
 * @since 1.0.0
 */
function ascension_remove_titles() {

	remove_action( 'primer_after_header', 'primer_add_page_builder_template_title', 100 );
	remove_action( 'primer_after_header', 'primer_add_blog_title', 100 );
	remove_action( 'primer_after_header', 'primer_add_archive_title', 100 );

}
add_action( 'wp_head', 'ascension_remove_titles' );

/**
 * Add images sizes.
 *
 * @action after_setup_theme
 * @since  1.0.0
 */
function ascension_add_image_sizes() {

	add_image_size( 'hero', 1060, 550, array( 'center', 'center' ) );
	add_image_size( 'hero-2x', 2120, 1100, array( 'center', 'center' ) );

}
add_action( 'after_setup_theme', 'ascension_add_image_sizes' );

/**
 * Update custom logo width and height.
 *
 * @filter primer_custom_logo_args
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function ascension_custom_logo_args( $args ) {

	$args['width']  = 352;
	$args['height'] = 62;

	return $args;

}
add_filter( 'primer_custom_logo_args', 'ascension_custom_logo_args' );

/**
 * Update custom header width and height
 *
 * @action primer_custom_header_args
 * @param $args
 * @return array
 */
function ascension_update_custom_header_args( $args ) {

	$args['width']         = 2120;
	$args['height']        = 1100;
	$args['default-image'] = get_stylesheet_directory_uri() . '/assets/img/default.jpg';


	return $args;

}
add_filter( 'primer_custom_header_args', 'ascension_update_custom_header_args' );

/**
 * Move Navigation from after header to inside header.
 *
 * @action after_setup_theme
 * @since  1.0.0
 */
function ascension_move_navigation() {

	remove_action( 'primer_after_header', 'primer_add_primary_navigation', 20 );

	add_action( 'primer_header', 'primer_add_primary_navigation', 20 );

}
add_action( 'after_setup_theme', 'ascension_move_navigation' );

/**
 * Display the hero before the header.
 *
 * @action after_setup_theme
 * @since  1.0.0
 */
function ascension_add_hero() {

	remove_action( 'primer_header', 'primer_add_hero', 10 );

	if ( is_404() || is_page_template( 'templates/page-builder-no-header.php' ) ) {

		return;

	}

	add_action( 'primer_after_header', 'primer_add_hero', 10 );

}
add_action( 'after_setup_theme', 'ascension_add_hero' );

/**
 * Register sidebar areas.
 *
 * @filter primer_sidebars
 * @since  1.0.0
 *
 * @param  array $sidebars
 *
 * @return array
 */
function ascension_sidebars( $sidebars ) {

	$sidebars[] = array(
		'name'          => esc_html__( 'Footer 4', 'ascension' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'This sidebar is the fourth column of the footer widget area.', 'ascension' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	);

	$sidebars[] = array(
		'name'          => esc_html__( 'Hero', 'ascension' ),
		'id'            => 'hero',
		'description'   => esc_html__( 'Hero widgets appear over the header image on the front page.', 'ascension' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	return $sidebars;

}
add_filter( 'primer_sidebars', 'ascension_sidebars' );

/**
 * Register font types.
 *
 * @action primer_font_types
 * @since  1.0.0
 *
 * @param  array $font_types
 *
 * @return array
 */
function ascension_font_types( $font_types ) {

	$font_types = array(
		'primary_font' => array(
			'label'   => esc_html__( 'Primary Font', 'primer' ),
			'default' => 'Open Sans',
			'css'     => array(
				'body,
				p,
				h1, h2, h3, h4, h5, h6,
				ul, ol, dl,
				blockquote,
				blockquote .aligncenter, blockquote .aligncenter cite,
				button, a.button, .social-menu a, input, select, textarea,
				label,
				legend,
				.main-navigation ul li a,
				.widget-title,
				.entry-footer,
				.entry-meta,
				.event-meta, .sermon-meta, .location-meta, .person-meta,
				.post-format,
				.more-link,
				article.format-link,
				.comment-list li .comment-author, .comment-list li .comment-metadata,
				#respond,
				.site-title,
				.site-description,
				.featured-content .entry-header .entry-title,
				.featured-content .entry-header .read-more' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
	);

	return $font_types;

}
add_filter( 'primer_font_types', 'ascension_font_types' );

/**
 * Register colors.
 *
 * @filter primer_colors
 * @since  1.0.0
 *
 * @param  array $colors
 *
 * @return array
 */
function ascension_colors( $colors ) {

	$colors = array(
		'header_textcolor' => array(
			'default' => '#194F6E',
			'css'     => array(
				'.site-title a, .site-title a:visited' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.site-title a:hover, .site-title a:visited:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		'background_color' => array(
			'default' => '#fff',
			'css'     => array(
				'body,
				.gallery-caption,
				.featured-content .entry-header .entry-header-column' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'tagline_text_color' => array(
			'label'   => esc_html__( 'Tagline Text Color', 'primer' ),
			'default' => '#545454',
			'css'     => array(
				'.site-description' => array(
					'color' => '%1$s',
				),
			),
		),
		'main_text_color' => array(
			'label'   => esc_html( 'Main Text Color', 'ascension' ),
			'default' => '#212121',
			'css'     => array(
				'body,
				.site-footer,
				.footer-widget-area .footer-widget .widget,
				h1,
				h2,
				h3,
				section.error-404 p,
				.widget_calendar #calendar_wrap #wp-calendar,
				.widget_calendar #calendar_wrap #wp-calendar tfoot td a,
				.widget_calendar #calendar_wrap #wp-calendar tbody tr td a,
				.widget_calendar #calendar_wrap #wp-calendar caption' => array(
					'color' => '%1$s',
				),
			),
		),
		'secondary_text_color' => array(
			'label'   => esc_html( 'Secondary Text Color', 'ascension' ),
			'default' => '#194F6E',
			'css'     => array(
				'h3,
				.hentry .entry-header,
				.entry-title a,
				.archive-title a,
				.site-info-wrapper .social-menu a,
				.site-info-wrapper .social-menu a:visited,
				.social-menu a,
				.social-menu a:visited,
				.widget-title' => array(
					'color' => '%1$s',
				),
				'.search-form .search-field,
				.bypostauthor,
				.main-navigation ul li.current-menu-item,
                .main-navigation ul li:hover,' => array(
					'border-color' => '%1$s',
				),
				'button,
				a.button,
				.social-menu a,
				.social-menu a:visited,
				a.button:visited,
				.social-menu a:visited,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.fl-builder-content a.fl-button,
				.fl-builder-content a.fl-button:visited,
				.main-navigation ul li a,
				.search-form .search-field' => array(
					'color' => '%1$s',
					'border-color' => '%1$s',
				),
				'.hero,
				button:hover,
				a.button:hover,
				.social-menu a:hover,
				a.button:visited:hover,
				.social-menu a:visited:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				.fl-builder-content a.fl-button:hover,
				.fl-builder-content a.fl-button:visited:hover,
				button:focus button:active,
				a.button:focus a.button:active,
				a.button:focus .social-menu a:focus,
				.social-menu a.button:focus a:focus,
				a.button:focus .social-menu a:active,
				.social-menu a.button:focus a:active,
				a.button:visited:focus a.button:visited:active,
				a.button:visited:focus .social-menu a:visited:focus,
				.social-menu a.button:visited:focus a:visited:focus,
				a.button:visited:focus .social-menu a:visited:active,
				.social-menu a.button:visited:focus a:visited:active,
				input[type="button"]:focus input[type="button"]:active,
				input[type="reset"]:focus input[type="reset"]:active,
				input[type="submit"]:focus input[type="submit"]:active,
				.fl-builder-content a.fl-button:focus .fl-builder-content a.fl-button:active,
				.fl-builder-content a.fl-button:visited:focus .fl-builder-content a.fl-button:visited:active,
				.social-menu a:hover,
				section.error-404 .search-submit:hover,
				.main-navigation ul li.menu-item-has-children .sub-menu li a' => array(
					'background-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.main-navigation ul li.menu-item-has-children .sub-menu li.current-menu-item a,
				.main-navigation ul li.menu-item-has-children .sub-menu li a:hover' => array(
					'background-color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		'tertiary_text_color' => array(
			'label'   => esc_html( 'Tertiary Text Color', 'ascension' ),
			'default' => '#757575',
			'css'     => array(
				'h1 small,
				h2 small,
				h3 small,
				h4 small,
				h5 small,
				h6 small,
				h4,
				h5,
				h6,
				.subheader,
				.footer-widget-area .site-description,
				.site-info-wrapper,
				.site-info-wrapper a,
				.site-info-wrapper .site-info-text,
				.site-info-wrapper .site-info-text p,
				legend,
				.menu-toggle,
				.widget_recent_entries .post-date,
				.sticky .entry-title a:before,
				.entry-footer,
				.entry-meta,
				section > h2,
				.comment-list .comment-awaiting-moderation,
				#respond .comment-notes,
				#respond .form-allowed-tags,
				#respond .logged-in-as,
				input[type="text"],
				input[type="email"],
				input[type="url"],
				input[type="password"],
				input[type="search"],
				input[type="number"],
				textarea,
				input[type="text"]:focus,
				input[type="email"]:focus,
				input[type="url"]:focus,
				input[type="password"]:focus,
				input[type="search"]:focus,
				input[type="number"]:focus,
				textarea:focus,
				hr,
				pre,
				code,
				blockquote cite,
				blockquote cite a,
				blockquote cite a:visited,
				blockquote,
				blockquote p' => array(
					'color' => '%1$s',
				),
				'table th,
				table td,
				abbr,
				acronym,
				fieldset,
				.main-navigation,
				.main-navigation ul li,
				.main-navigation ul li.menu-item-has-children > a > span,
				.main-navigation ul li.menu-item-has-children .sub-menu li,
				.widget li,
				section > h2,
				.comment-list li.pingback,
				.comment-list li.trackback,
				.comment-list .comment-awaiting-moderation,
				.featured-content .entry-header .entry-meta' => array(
					'border-color' => '%1$s',
				),
			),
		),
		'accent_color' => array(
			'label'   => esc_html__( 'Accent Color', 'primer' ),
			'default' => '#39BAF3',
			'css' => array(
				'.hero a.button.large,
				.hero .social-menu a.large,
				.social-menu .hero a.large' => array(
					'background-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.hero a.button.large:hover,
				.hero .social-menu a.large:hover,
				.social-menu .hero a.large:hover' => array(
					'background-color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		'light_color' => array(
			'label'   => esc_html( 'Light Color', 'ascension' ),
			'default' => '#fff',
			'css' => array(
				'.main-navigation ul li.menu-item-has-children .sub-menu li a,
				.gallery-caption,
				.featured-content .entry-header,
				.featured-content .entry-header .entry-title,
				.featured-content .entry-header .entry-title a,
				featured-content .entry-header .entry-header-column,
				.featured-content .entry-header .entry-meta,
				.hero .hero-wrapper,
				.hero h1,
				.hero h1,
				.hero h2,
				.hero h3,
				.hero h4,
				.hero h5,
				.hero h6,
				.hero code,
				.hero pre,
				.hero blockquote,
				.hero p,
				.hero blockquote.large,
				.hero blockquote.large p,
				.hero a.button.large,
				.hero .social-menu a.large,
				.social-menu .hero a.large,
				.footer-widget-area a.button:hover,
				.footer-widget-area .social-menu a:hover,
				.social-menu .footer-widget-area a:hover,
				.featured-content,
				.featured-content .entry-title a,
				.featured-content article' => array(
					'color' => '%1$s',
				),
				'.search-form .search-field,
				.main-navigation,
				.widget_calendar #calendar_wrap #wp-calendar td,
				.widget_calendar #calendar_wrap #wp-calendar th,
				.widget_calendar #calendar_wrap #wp-calendar caption,
				.widget_calendar #calendar_wrap #wp-calendar thead th,
				.widget_calendar #calendar_wrap #wp-calendar tbody tr td a,
				input[type="text"],
				input[type="email"],
				input[type="url"],
				input[type="password"],
				input[type="search"],
				input[type="number"],
				textarea,' => array(
					'background-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
				'.widget_calendar #calendar_wrap #wp-calendar tfoot,
				article.format-link' => array(
					'background-color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
		'link_color' => array(
			'label'   => esc_html__( 'Link Color', 'primer' ),
			'default' => '#39BAF3',
			'css'     => array(
				'a,
				.featured-content .read-more,
				.hero blockquote cite,
				.hero blockquote cite a,
				.featured-content .entry-header .post-format,
				.post-format,
				.entry-footer a,
				.widget_calendar #calendar_wrap #wp-calendar tfoot td a:hover,
				abbr,
				acronym,
				.entry-footer a:hover,
				.entry-footer a:focus,
				.entry-footer a:active' => array(
					'color' => '%1$s',
				),
				'.featured-content .entry-header .read-more' => array(
					'backgroud-color' => '%1$s',
				),
				'.featured-content .entry-header .read-more,
				.more-link' => array(
					'border-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'a:hover, a:focus, a:focus,
				.featured-content .read-more:hover' => array(
					'color' => 'rgba(%1$s, 0.8)',
				),
				'.featured-content .entry-header .read-more:hover' => array(
					'background-color' => 'rgba(%1$s, 0.8)',
				),
			),
		),
	);

	return $colors;

}
add_filter( 'primer_colors', 'ascension_colors' );

/**
 * Register color schemes.
 *
 * @filter primer_color_schemes
 * @since  1.0.0
 *
 * @param  array $color_schemes
 *
 * @return array
 */
function ascension_color_schemes( $color_schemes ) {

	$color_schemes = array(
		'dark' => array(
			'label'  => esc_html__( 'Dark', 'ascension' ),
			'colors' => array(
				'header_textcolor'     => '#ffffff',
				'background_color'     => '#333333',
				'tagline_text_color'   => '#919191',
				'main_text_color'      => '#ffffff',
				'secondary_text_color' => '#ffffff',
				'tertiary_text_color'  => '#7f7f7f',
				'accent_color'         => '#39baf3',
				'light_color'          => '#ffffff',
				'link_color'           => '#39baf3',
			),
		),
		'green' => array(
			'label'  => esc_html__( 'Green', 'ascension' ),
			'colors' => array(
				'header_textcolor'     => '#0b560c',
				'background_color'     => '#f4f4f4',
				'tagline_text_color'   => '#545454',
				'main_text_color'      => '#212121',
				'secondary_text_color' => '#0b560c',
				'tertiary_text_color'  => '#757575',
				'accent_color'         => '#49a00b',
				'light_color'          => '#ffffff',
				'link_color'           => '#49a00b',
			),
		),
	);

	return $color_schemes;

}
add_filter( 'primer_color_schemes', 'ascension_color_schemes' );
