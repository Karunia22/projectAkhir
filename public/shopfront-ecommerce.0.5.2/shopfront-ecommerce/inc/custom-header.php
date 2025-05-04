<?php
/**
 * @package Shopfront Ecommerce
 * Setup the WordPress core custom header feature.
 *
 * @uses shopfront_ecommerce_header_style()
 */
function shopfront_ecommerce_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'shopfront_ecommerce_custom_header_args', array(		
		'default-text-color'     => 'fff',
		'width'                  => 2000,
		'height'                 => 280,
		'wp-head-callback'       => 'shopfront_ecommerce_header_style',		
	) ) );
}
add_action( 'after_setup_theme', 'shopfront_ecommerce_custom_header_setup' );

if ( ! function_exists( 'shopfront_ecommerce_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see shopfront_ecommerce_custom_header_setup().
 */
function shopfront_ecommerce_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		.header {
			background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat !important;
			background-position: center top; background-size:100% 100% !important;
		}
	<?php endif; ?>	

	.header .site-title a {
		color: <?php echo esc_attr(get_theme_mod('shopfront_ecommerce_sitetitle_color')); ?>;
	}

	.header .site-description {
		color: <?php echo esc_attr(get_theme_mod('shopfront_ecommerce_siteTagline_color')); ?>;
	}

	.header {
		background: <?php echo esc_attr(get_theme_mod('shopfront_ecommerce_headerbg_color')); ?> !important;
	}

	.header-top {
		background: <?php echo esc_attr(get_theme_mod('shopfront_ecommerce_topheaderbg_color')); ?> !important;
	}

	.product_cat_box h3 {
		color: <?php echo esc_attr(get_theme_mod('shopfront_ecommerce_category_title_color')); ?>;
	}

	.copywrap, .copywrap p, .copywrap p a{
		color: <?php echo esc_attr(get_theme_mod('shopfront_ecommerce_footercoypright_color')); ?> !important;
	}
	#footer h3 {
		color: <?php echo esc_attr(get_theme_mod('shopfront_ecommerce_footertitle_color')); ?> !important;

	}
	#footer .textwidget p {
		color: <?php echo esc_attr(get_theme_mod('shopfront_ecommerce_footerdescription_color')); ?>;
	}
	#footer a {
		color: <?php echo esc_attr(get_theme_mod('shopfront_ecommerce_footerlist_color')); ?>;
	}
	#footer {
		background-color: <?php echo esc_attr(get_theme_mod('shopfront_ecommerce_footerbg_color')); ?>;
	}

	</style>
	<?php
}
endif;