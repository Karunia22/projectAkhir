<?php
/**
 * Shopfront Ecommerce functions and definitions
 *
 * @package Shopfront Ecommerce
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'shopfront_ecommerce_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function shopfront_ecommerce_setup() {
	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 680;

	load_theme_textdomain( 'shopfront-ecommerce', get_template_directory() . '/languages' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header', array(
		'default-text-color' => false,
		'header-text' => false,
	) );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
	) );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'shopfront-ecommerce' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	add_editor_style( 'editor-style.css' );
}
endif; // shopfront_ecommerce_setup
add_action( 'after_setup_theme', 'shopfront_ecommerce_setup' );

function shopfront_ecommerce_the_breadcrumb() {
    echo '<div class="breadcrumb my-3">';

    if (!is_home()) {
        echo '<a class="home-main align-self-center" href="' . esc_url(home_url()) . '">';
        bloginfo('name');
        echo "</a>";

        if (is_category() || is_single()) {
            the_category(' , ');
            if (is_single()) {
                echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (is_page()) {
            echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
        }
    }

    echo '</div>';
}

function shopfront_ecommerce_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'shopfront-ecommerce' ),
		'description'   => __( 'Appears on blog page sidebar', 'shopfront-ecommerce' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'shopfront-ecommerce' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'shopfront-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'shopfront-ecommerce' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'shopfront-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'shopfront-ecommerce' ),
		'description'   => __( 'Appears on shop page', 'shopfront-ecommerce' ),
		'id'            => 'woocommerce_sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar(array(
        'name'          => __('Single Product Sidebar', 'shopfront-ecommerce'),
        'description'   => __('Sidebar for single product pages', 'shopfront-ecommerce'),
		'id'            => 'woocommerce-single-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));	

	$shopfront_ecommerce_widget_areas = get_theme_mod('shopfront_ecommerce_footer_widget_areas', '4');
	for ($shopfront_ecommerce_i=1; $shopfront_ecommerce_i <= 4; $shopfront_ecommerce_i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Widget ', 'shopfront-ecommerce' ) . $shopfront_ecommerce_i,
			'id'            => 'footer-' . $shopfront_ecommerce_i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="ftr-4-box widget-column-4 %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'shopfront_ecommerce_widgets_init' );


// Change number of products per row to 3
add_filter('loop_shop_columns', 'shopfront_ecommerce_loop_columns');
if (!function_exists('shopfront_ecommerce_loop_columns')) {
    function shopfront_ecommerce_loop_columns() {
        $colm = get_theme_mod('shopfront_ecommerce_products_per_row', 3); // Default to 3 if not set
        return $colm;
    }
}

// Use the customizer setting to set the number of products per page
function shopfront_ecommerce_products_per_page($cols) {
    $cols = get_theme_mod('shopfront_ecommerce_products_per_page', 9); // Default to 9 if not set
    return $cols;
}
add_filter('loop_shop_per_page', 'shopfront_ecommerce_products_per_page', 9);

function shopfront_ecommerce_scripts() {

	wp_enqueue_style( 'owl.carousel-css', esc_url(get_template_directory_uri())."/css/owl.carousel.css" );
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri())."/css/bootstrap.css" );
	wp_enqueue_style( 'shopfront-ecommerce-style', get_stylesheet_uri() );
	wp_style_add_data('shopfront-ecommerce-style', 'rtl', 'replace');
	wp_enqueue_style( 'shopfront-ecommerce-responsive', esc_url(get_template_directory_uri())."/css/responsive.css" );
	wp_enqueue_style( 'shopfront-ecommerce-default', esc_url(get_template_directory_uri())."/css/default.css" );

	require get_parent_theme_file_path( '/inc/color-scheme/custom-color-control.php' );
	wp_add_inline_style( 'shopfront-ecommerce-style',$shopfront_ecommerce_color_scheme_css );
	
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()). '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'owl.carousel-js', esc_url(get_template_directory_uri()). '/js/owl.carousel.js', array('jquery') );
	wp_enqueue_script( 'shopfront-ecommerce-theme', esc_url(get_template_directory_uri()) . '/js/theme.js' );

	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri())."/css/fontawesome-all.css" );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// font-family
	$headings_font = esc_html(get_theme_mod('shopfront_ecommerce_headings_fonts'));
	$body_font = esc_html(get_theme_mod('shopfront_ecommerce_body_fonts'));

	if ($headings_font) {
	    wp_enqueue_style('shopfront-ecommerce-headings-fonts', 'https://fonts.googleapis.com/css?family=' . $headings_font);
	} else {
	    wp_enqueue_style('oswald', 'https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700');
	}

	if ($body_font) {
	    wp_enqueue_style('poppins', 'https://fonts.googleapis.com/css?family=' . $body_font);
	} else {
	    wp_enqueue_style('shopfront-ecommerce-source-body', 'https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900');
	}
}
add_action( 'wp_enqueue_scripts', 'shopfront_ecommerce_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/upgrade-to-pro.php';

/**
 * Theme Info Page.
 */
require get_template_directory() . '/inc/addon.php';

// select
require get_template_directory() . '/inc/select/category-dropdown-custom-control.php';

/**
 * Load TGM.
 */
require get_template_directory() . '/inc/tgm/tgm.php';

if ( ! defined( 'SHOPFRONT_ECOMMERCE_PRO_NAME' ) ) {
	define( 'SHOPFRONT_ECOMMERCE_PRO_NAME', __( 'About Shopfront Ecommerce', 'shopfront-ecommerce' ));
}

if ( ! defined( 'SHOPFRONT_ECOMMERCE_THEME_PAGE' ) ) {
define('SHOPFRONT_ECOMMERCE_THEME_PAGE',__('https://www.theclassictemplates.com/collections/best-wordpress-templates','shopfront-ecommerce'));
}
if ( ! defined( 'SHOPFRONT_ECOMMERCE_SUPPORT' ) ) {
define('SHOPFRONT_ECOMMERCE_SUPPORT',__('https://wordpress.org/support/theme/shopfront-ecommerce/','shopfront-ecommerce'));
}
if ( ! defined( 'SHOPFRONT_ECOMMERCE_REVIEW' ) ) {
define('SHOPFRONT_ECOMMERCE_REVIEW',__('https://wordpress.org/support/theme/shopfront-ecommerce/reviews/','shopfront-ecommerce'));
}
if ( ! defined( 'SHOPFRONT_ECOMMERCE_PRO_DEMO' ) ) {
define('SHOPFRONT_ECOMMERCE_PRO_DEMO',__('https://live.theclassictemplates.com/shopfront-ecommerce-pro/','shopfront-ecommerce'));
}
if ( ! defined( 'SHOPFRONT_ECOMMERCE_PREMIUM_PAGE' ) ) {
define('SHOPFRONT_ECOMMERCE_PREMIUM_PAGE',__('https://www.theclassictemplates.com/products/wordpress-ecommerce-theme','shopfront-ecommerce'));
}
if ( ! defined( 'SHOPFRONT_ECOMMERCE_THEME_DOCUMENTATION' ) ) {
define('SHOPFRONT_ECOMMERCE_THEME_DOCUMENTATION',__('https://live.theclassictemplates.com/demo/docs/shopfront-ecommerce-free/','shopfront-ecommerce'));
}

/* Starter Content */
add_theme_support( 'starter-content', array(
	'widgets' => array(
		'footer-1' => array(
			'categories',
		),
		'footer-2' => array(
			'archives',
		),
		'footer-3' => array(
			'meta',
		),
		'footer-4' => array(
			'search',
		),
	),
));

// logo
if ( ! function_exists( 'shopfront_ecommerce_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function shopfront_ecommerce_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

$woocommerce_sidebar = get_theme_mod( 'shopfront_ecommerce_woocommerce_sidebar_product' );
	if ( 'false' == $woocommerce_sidebar ) {
$woo_product_column = 'col-lg-12 col-md-12';
	} else {
$woo_product_column = 'col-lg-9 col-md-9';
}

$woocommerce_shop_sidebar = get_theme_mod( 'shopfront_ecommerce_woocommerce_sidebar_shop' );
	if ( 'false' == $woocommerce_shop_sidebar ) {
$woo_shop_column = 'col-lg-12 col-md-12';
	} else {
$woo_shop_column = 'col-lg-9 col-md-9';
}
