<?php
/**
 * Shopfront Ecommerce Theme Customizer
 *
 * @package Shopfront Ecommerce
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shopfront_ecommerce_customize_register( $wp_customize ) {

	function shopfront_ecommerce_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

	function shopfront_ecommerce_sanitize_number_absint( $number, $setting ) {
		// Ensure $number is an absolute integer (whole number, zero or greater).
		$number = absint( $number );
		
		// If the input is an absolute integer, return it; otherwise, return the default
		return ( $number ? $number : $setting->default );
	}

	function shopfront_ecommerce_sanitize_select( $input, $setting ){
        //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
        $input = sanitize_key($input);
        //get the list of possible select options
        $choices = $setting->manager->get_control( $setting->id )->choices;
        //return input if valid or return default option
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }

	wp_enqueue_style('shopfront-ecommerce-customize-controls', trailingslashit(esc_url(get_template_directory_uri())).'/css/customize-controls.css');

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	//Logo
    $wp_customize->add_setting('shopfront_ecommerce_logo_width',array(
		'default'=> '',
		'transport' => 'refresh',
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_integer'
	));
	$wp_customize->add_control(new Shopfront_Ecommerce_Slider_Custom_Control( $wp_customize, 'shopfront_ecommerce_logo_width',array(
		'label'	=> esc_html__('Logo Width','shopfront-ecommerce'),
		'section'=> 'title_tagline',
		'settings'=>'shopfront_ecommerce_logo_width',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting('shopfront_ecommerce_title_enable',array(
		'default' => false,
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_title_enable', array(
	   'settings' => 'shopfront_ecommerce_title_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Title','shopfront-ecommerce'),
	   'type'      => 'checkbox'
	));

	// site title color 
	$wp_customize->add_setting('shopfront_ecommerce_sitetitle_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_sitetitle_color', array(
	   'settings' => 'shopfront_ecommerce_sitetitle_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Title Color', 'shopfront-ecommerce'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('shopfront_ecommerce_tagline_enable',array(
		'default' => true,
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_tagline_enable', array(
	   'settings' => 'shopfront_ecommerce_tagline_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Tagline','shopfront-ecommerce'),
	   'type'      => 'checkbox'
	));

	// site Tagline color
	$wp_customize->add_setting('shopfront_ecommerce_siteTagline_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_siteTagline_color', array(
	   'settings' => 'shopfront_ecommerce_siteTagline_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Tagline Color', 'shopfront-ecommerce'),
	   'type'      => 'color'
	));

	// woocommerce section
	$wp_customize->add_section('shopfront_ecommerce_woocommerce_page_settings', array(
		'title'    => __('WooCommerce Page Settings', 'shopfront-ecommerce'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	$wp_customize->add_setting('shopfront_ecommerce_shop_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'shopfront_ecommerce_sanitize_checkbox'
	 ));
	 $wp_customize->add_control('shopfront_ecommerce_shop_page_sidebar',array(
		'type' => 'checkbox',
		'label' => __(' Check To Enable Shop page sidebar','shopfront-ecommerce'),
		'section' => 'shopfront_ecommerce_woocommerce_page_settings',
	 ));

    // shop page sidebar alignment
    $wp_customize->add_setting('shopfront_ecommerce_shop_page_sidebar_position', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_choices',
	));
	$wp_customize->add_control('shopfront_ecommerce_shop_page_sidebar_position',array(
		'type'           => 'radio',
		'label'          => __('Shop Page Sidebar', 'shopfront-ecommerce'),
		'section'        => 'shopfront_ecommerce_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'shopfront-ecommerce'),
			'Right Sidebar' => __('Right Sidebar', 'shopfront-ecommerce'),
		),
	));	 

	$wp_customize->add_setting( 'shopfront_ecommerce_single_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'shopfront_ecommerce_sanitize_checkbox'
    ) );
    $wp_customize->add_control('shopfront_ecommerce_single_page_sidebar',array(
    	'type' => 'checkbox',
       	'label' => __('Check To Enable Single Product Page Sidebar','shopfront-ecommerce'),
		'section' => 'shopfront_ecommerce_woocommerce_page_settings'
    ));

	// single product page sidebar alignment
    $wp_customize->add_setting('shopfront_ecommerce_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_choices',
	));
	$wp_customize->add_control('shopfront_ecommerce_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single product Page Sidebar', 'shopfront-ecommerce'),
		'section'        => 'shopfront_ecommerce_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'shopfront-ecommerce'),
			'Right Sidebar' => __('Right Sidebar', 'shopfront-ecommerce'),
		),
	));	

	$wp_customize->add_setting( 'shopfront_ecommerce_woo_product_img_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'shopfront_ecommerce_sanitize_integer'
    ) );
    $wp_customize->add_control(new shopfront_ecommerce_Slider_Custom_Control( $wp_customize, 'shopfront_ecommerce_woo_product_img_border_radius',array(
		'label'	=> esc_html__('Woo Product Img Border Radius','shopfront-ecommerce'),
		'section'=> 'shopfront_ecommerce_woocommerce_page_settings',
		'settings'=>'shopfront_ecommerce_woo_product_img_border_radius',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

    // Add a setting for number of products per row
    $wp_customize->add_setting('shopfront_ecommerce_products_per_row', array(
	   'default'   => '3',
	   'transport' => 'refresh',
	   'sanitize_callback' => 'shopfront_ecommerce_sanitize_integer'
    ));
    $wp_customize->add_control('shopfront_ecommerce_products_per_row', array(
	   'label'    => __('Woo Products Per Row', 'shopfront-ecommerce'),
	   'section'  => 'shopfront_ecommerce_woocommerce_page_settings',
	   'settings' => 'shopfront_ecommerce_products_per_row',
	   'type'     => 'select',
	   'choices'  => array(
		  '2' => '2',
		  '3' => '3',
		  '4' => '4',
	   ),
    ));

	// Add a setting for the number of products per page
	$wp_customize->add_setting('shopfront_ecommerce_products_per_page', array(
		'default'   => '9',
		'transport' => 'refresh',
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_integer'
	));
	$wp_customize->add_control('shopfront_ecommerce_products_per_page', array(
		'label'    => __('Woo Products Per Page', 'shopfront-ecommerce'),
		'section'  => 'shopfront_ecommerce_woocommerce_page_settings',
		'settings' => 'shopfront_ecommerce_products_per_page',
		'type'     => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'step' => 1,
		),
	));

	//Theme Options
	$wp_customize->add_panel( 'shopfront_ecommerce_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'shopfront-ecommerce' ),
	) );
	
	//Site Layout Section
	$wp_customize->add_section('shopfront_ecommerce_site_layoutsec',array(
		'title'	=> __('Manage Site Layout Section','shopfront-ecommerce'),
		'description' => __('<p class="sec-title">Manage Site Layout Section</p>','shopfront-ecommerce'),
		'priority'	=> 1,
		'panel' => 'shopfront_ecommerce_panel_area',
	));		

	$wp_customize->add_setting('shopfront_ecommerce_preloader',array(
		'default' => false,
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));	 
	$wp_customize->add_control( 'shopfront_ecommerce_preloader', array(
	   'section'   => 'shopfront_ecommerce_site_layoutsec',
	   'label'	=> __('Check to show preloader','shopfront-ecommerce'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('shopfront_ecommerce_preloader_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'shopfront_ecommerce_preloader_bg_image',array(
        'section' => 'shopfront_ecommerce_site_layoutsec',
		'label' => __('Preloader Background Image','shopfront-ecommerce'),
	)));

	$wp_customize->add_setting('shopfront_ecommerce_box_layout',array(
		'default' => false,
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));	 
	$wp_customize->add_control( 'shopfront_ecommerce_box_layout', array(
	   'section'   => 'shopfront_ecommerce_site_layoutsec',
	   'label'	=> __('Check to Box Layout','shopfront-ecommerce'),
	   'type'      => 'checkbox'
 	));	

	$wp_customize->add_setting( 'shopfront_ecommerce_theme_page_breadcrumb',array(
		'default' => false,
        'sanitize_callback'	=> 'shopfront_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('shopfront_ecommerce_theme_page_breadcrumb',array(
       'section' => 'shopfront_ecommerce_site_layoutsec',
	   'label' => __( 'Check To Enable Theme Page Breadcrumb','shopfront-ecommerce' ),
	   'type' => 'checkbox'
    ));	

    // Add Settings and Controls for Page Layout
    $wp_customize->add_setting('shopfront_ecommerce_sidebar_page_layout',array(
	  'default' => 'full',
	  'sanitize_callback' => 'shopfront_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('shopfront_ecommerce_sidebar_page_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Page Sidebar Position', 'shopfront-ecommerce'),
		'section' => 'shopfront_ecommerce_site_layoutsec',
		'choices' => array(
			'left' => __('Left','shopfront-ecommerce'),
			'right' => __('Right','shopfront-ecommerce'),
			'full' => __('No Sidebar','shopfront-ecommerce')
	),
	));	

	$wp_customize->add_setting( 'shopfront_ecommerce_layout_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('shopfront_ecommerce_layout_settings_upgraded_features', array(
		  'type'=> 'hidden',
		  'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			  <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-theme') ." '>Upgrade to Pro</a></span>",
		  'section' => 'shopfront_ecommerce_site_layoutsec'
	));

	//Global Color
	$wp_customize->add_section('shopfront_ecommerce_global_color', array(
		'title'    => __('Manage Global Color Section', 'shopfront-ecommerce'),
		'panel'    => 'shopfront_ecommerce_panel_area',
	));

	$wp_customize->add_setting('shopfront_ecommerce_first_color', array(
		'default'           => '#f07f13',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'shopfront_ecommerce_first_color', array(
		'label'    => __('Theme Color', 'shopfront-ecommerce'),
		'section'  => 'shopfront_ecommerce_global_color',
		'settings' => 'shopfront_ecommerce_first_color',
	)));	

	$wp_customize->add_setting('shopfront_ecommerce_second_color', array(
		'default'           => '#333333',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'shopfront_ecommerce_second_color', array(
		'label'    => __('Theme Color', 'shopfront-ecommerce'),
		'section'  => 'shopfront_ecommerce_global_color',
		'settings' => 'shopfront_ecommerce_second_color',
	)));

	$wp_customize->add_setting( 'shopfront_ecommerce_global_color_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('shopfront_ecommerce_global_color_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-theme') ." '>Upgrade to Pro</a></span>",
		'section' => 'shopfront_ecommerce_global_color'
	));	
	
 	// Header Section
	$wp_customize->add_section('shopfront_ecommerce_header_section', array(
        'title' => __('Manage Header Section', 'shopfront-ecommerce'),
		'description' => __('<p class="sec-title">Manage Header Section</p>','shopfront-ecommerce'),
        'priority' => null,
		'panel' => 'shopfront_ecommerce_panel_area',
 	));

	$wp_customize->add_setting('shopfront_ecommerce_top_bar',array(
		'default' => true,
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));	 
	$wp_customize->add_control( 'shopfront_ecommerce_top_bar', array(
	   'section'   => 'shopfront_ecommerce_header_section',
	   'label'	=> __('Check to show top bar','shopfront-ecommerce'),
	   'type'      => 'checkbox'
 	)); 

 	$wp_customize->add_setting('shopfront_ecommerce_stickyheader',array(
		'default' => true,
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_stickyheader', array(
	   'section'   => 'shopfront_ecommerce_header_section',
	   'label'	=> __('Check To Show Sticky Header','shopfront-ecommerce'),
	   'type'      => 'checkbox'
 	));	

	$wp_customize->add_setting('shopfront_ecommerce_offer_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_offer_text', array(
	   'settings' => 'shopfront_ecommerce_offer_text',
	   'section'   => 'shopfront_ecommerce_header_section',
	   'label' => __('Add Offer Text', 'shopfront-ecommerce'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('shopfront_ecommerce_category_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_category_text', array(
	   'settings' => 'shopfront_ecommerce_category_text',
	   'section'   => 'shopfront_ecommerce_header_section',
	   'label' => __('Add Category Text', 'shopfront-ecommerce'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('shopfront_ecommerce_product_category_number',array(
		'default' => '',
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_number_absint',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_product_category_number', array(
	   'settings' => 'shopfront_ecommerce_product_category_number',
	   'section'   => 'shopfront_ecommerce_header_section',
	   'label' => __('Add Category Limit', 'shopfront-ecommerce'),
	   'type'      => 'number'
	));

	// header bg color
	$wp_customize->add_setting('shopfront_ecommerce_headerbg_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_headerbg_color', array(
	   'settings' => 'shopfront_ecommerce_headerbg_color',
	   'section'   => 'shopfront_ecommerce_header_section',
	   'label' => __('Header BG Color', 'shopfront-ecommerce'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting( 'shopfront_ecommerce_header_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('shopfront_ecommerce_header_settings_upgraded_features', array(
		  'type'=> 'hidden',
		  'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			  <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-theme') ." '>Upgrade to Pro</a></span>",
		  'section' => 'shopfront_ecommerce_header_section'
	));

	// Social media Section
	$wp_customize->add_section('shopfront_ecommerce_social_media_section', array(
        'title' => __('Manage Social media Section', 'shopfront-ecommerce'),
		'description' => __('<p class="sec-title">Manage Social media Section</p>','shopfront-ecommerce'),
        'priority' => null,
		'panel' => 'shopfront_ecommerce_panel_area',
 	));

	$wp_customize->add_setting('shopfront_ecommerce_fb_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_fb_link', array(
	   'settings' => 'shopfront_ecommerce_fb_link',
	   'section'   => 'shopfront_ecommerce_social_media_section',
	   'label' => __('Facebook Link', 'shopfront-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('shopfront_ecommerce_twitt_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_twitt_link', array(
	   'settings' => 'shopfront_ecommerce_twitt_link',
	   'section'   => 'shopfront_ecommerce_social_media_section',
	   'label' => __('Twitter Link', 'shopfront-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('shopfront_ecommerce_linked_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_linked_link', array(
	   'settings' => 'shopfront_ecommerce_linked_link',
	   'section'   => 'shopfront_ecommerce_social_media_section',
	   'label' => __('Linkdin Link', 'shopfront-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('shopfront_ecommerce_insta_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_insta_link', array(
	   'settings' => 'shopfront_ecommerce_insta_link',
	   'section'   => 'shopfront_ecommerce_social_media_section',
	   'label' => __('Instagram Link', 'shopfront-ecommerce'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('shopfront_ecommerce_whatsapp_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_whatsapp_link', array(
	   'settings' => 'shopfront_ecommerce_whatsapp_link',
	   'section'   => 'shopfront_ecommerce_social_media_section',
	   'label' => __('Whatsapp Link', 'shopfront-ecommerce'),
	   'type'      => 'url'
	));

	// top header bg color
	$wp_customize->add_setting('shopfront_ecommerce_topheaderbg_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_topheaderbg_color', array(
	   'settings' => 'shopfront_ecommerce_topheaderbg_color',
	   'section'   => 'shopfront_ecommerce_social_media_section',
	   'label' => __('BG Color', 'shopfront-ecommerce'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting( 'shopfront_ecommerce_media_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('shopfront_ecommerce_media_settings_upgraded_features', array(
		  'type'=> 'hidden',
		  'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			  <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-theme') ." '>Upgrade to Pro</a></span>",
		  'section' => 'shopfront_ecommerce_social_media_section'
	));

	// Home Category Dropdown Section
	$wp_customize->add_section('shopfront_ecommerce_one_cols_section',array(
		'title'	=> __('Manage Slider Section','shopfront-ecommerce'),
		'description'	=> __('<p class="sec-title">Manage Slider Section</p> Select Category from the Dropdowns for slider, Also use the given image dimension (1400 x 600).','shopfront-ecommerce'),
		'priority'	=> null,
		'panel' => 'shopfront_ecommerce_panel_area'
	));

	//Hide Section
	$wp_customize->add_setting('shopfront_ecommerce_hide_categorysec',array(
		'default' => false,
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	$wp_customize->add_control( 'shopfront_ecommerce_hide_categorysec', array(
	   'settings' => 'shopfront_ecommerce_hide_categorysec',
	   'section'   => 'shopfront_ecommerce_one_cols_section',
	   'label'     => __('Check To Enable This Section','shopfront-ecommerce'),
	   'type'      => 'checkbox'
	));

	// Add a category dropdown Slider Coloumn
	$wp_customize->add_setting( 'shopfront_ecommerce_slidersection', array(
		'default'	=> '0',	
		'sanitize_callback'	=> 'absint'
	));
	$wp_customize->add_control( new Shopfront_Ecommerce_Category_Dropdown_Custom_Control( $wp_customize, 'shopfront_ecommerce_slidersection', array(
		'section' => 'shopfront_ecommerce_one_cols_section',
	   'label' => __('Select Category to display Slider', 'shopfront-ecommerce'),
		'settings'   => 'shopfront_ecommerce_slidersection',
	)));

	$wp_customize->add_setting('shopfront_ecommerce_button_text',array(
		'default' => 'SHOP NOW',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_button_text', array(
	   'settings' => 'shopfront_ecommerce_button_text',
	   'section'   => 'shopfront_ecommerce_one_cols_section',
	   'label' => __('Add Button Text', 'shopfront-ecommerce'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('shopfront_ecommerce_button_link_slider',array(
        'default'=> '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('shopfront_ecommerce_button_link_slider',array(
        'label' => esc_html__('Add Button Link','shopfront-ecommerce'),
        'section'=> 'shopfront_ecommerce_one_cols_section',
        'type'=> 'url'
    ));

    //Slider height
    $wp_customize->add_setting('shopfront_ecommerce_slider_img_height',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('shopfront_ecommerce_slider_img_height',array(
        'label' => __('Slider Image Height','shopfront-ecommerce'),
        'description'   => __('Add the slider image height here (eg. 600px)','shopfront-ecommerce'),
        'input_attrs' => array(
            'placeholder' => __( '500px', 'shopfront-ecommerce' ),
        ),
        'section'=> 'shopfront_ecommerce_one_cols_section',
        'type'=> 'text'
    ));

    $wp_customize->add_setting( 'shopfront_ecommerce_slider_settings_upgraded_features',array(
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('shopfront_ecommerce_slider_settings_upgraded_features', array(
	    'type'=> 'hidden',
	    'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	        <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-theme') ." '>Upgrade to Pro</a></span>",
	    'section' => 'shopfront_ecommerce_one_cols_section'
	));

	// Products Category Section
	$wp_customize->add_section('shopfront_ecommerce_category', array(
		'title'	=> __('Manage Category Section','shopfront-ecommerce'),
		'description'	=> __('<p class="sec-title">Manage Category Section</p> You need to do is create product categories and images for those categories.','shopfront-ecommerce'),
		'priority'	=> null,
		'panel' => 'shopfront_ecommerce_panel_area',
	));

	//Hide Section
	$wp_customize->add_setting('shopfront_ecommerce_procat_show',array(
		'default' => false,
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	$wp_customize->add_control( 'shopfront_ecommerce_procat_show', array(
	   'settings' => 'shopfront_ecommerce_procat_show',
	   'section'   => 'shopfront_ecommerce_category',
	   'label'     => __('Check To Enable This Section','shopfront-ecommerce'),
	   'type'      => 'checkbox'
	));

	// category title color
	$wp_customize->add_setting('shopfront_ecommerce_category_title_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_category_title_color', array(
	   'settings' => 'shopfront_ecommerce_category_title_color',
	   'section'   => 'shopfront_ecommerce_category',
	   'label' => __(' Title  Color', 'shopfront-ecommerce'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting( 'shopfront_ecommerce_secondsec_settings_upgraded_features',array(
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('shopfront_ecommerce_secondsec_settings_upgraded_features', array(
	  'type'=> 'hidden',
	  'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	      <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-theme') ." '>Upgrade to Pro</a></span>",
	  'section' => 'shopfront_ecommerce_category'
	));

	//Blog post
	$wp_customize->add_section('shopfront_ecommerce_blog_post_settings',array(
        'title' => __('Manage Post Section', 'shopfront-ecommerce'),
        'priority' => null,
        'panel' => 'shopfront_ecommerce_panel_area'
    ) );

	$wp_customize->add_setting('shopfront_ecommerce_metafields_date', array(
	    'default' => true,
	    'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('shopfront_ecommerce_metafields_date', array(
	    'settings' => 'shopfront_ecommerce_metafields_date', 
	    'section'   => 'shopfront_ecommerce_blog_post_settings',
	    'label'     => __('Check to Enable Date', 'shopfront-ecommerce'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('shopfront_ecommerce_metafields_comments', array(
		'default' => true,
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));	
	$wp_customize->add_control('shopfront_ecommerce_metafields_comments', array(
		'settings' => 'shopfront_ecommerce_metafields_comments',
		'section'  => 'shopfront_ecommerce_blog_post_settings',
		'label'    => __('Check to Enable Comments', 'shopfront-ecommerce'),
		'type'     => 'checkbox',
	));

	$wp_customize->add_setting('shopfront_ecommerce_metafields_author', array(
		'default' => true,
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('shopfront_ecommerce_metafields_author', array(
		'settings' => 'shopfront_ecommerce_metafields_author',
		'section'  => 'shopfront_ecommerce_blog_post_settings',
		'label'    => __('Check to Enable Author', 'shopfront-ecommerce'),
		'type'     => 'checkbox',
	));		

	$wp_customize->add_setting('shopfront_ecommerce_metafields_time', array(
		'default' => true,
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('shopfront_ecommerce_metafields_time', array(
		'settings' => 'shopfront_ecommerce_metafields_time',
		'section'  => 'shopfront_ecommerce_blog_post_settings',
		'label'    => __('Check to Enable Time', 'shopfront-ecommerce'),
		'type'     => 'checkbox',
	));	

	$wp_customize->add_setting('shopfront_ecommerce_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('shopfront_ecommerce_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','shopfront-ecommerce'),
		'description' => __('Ex: "/", "|", "-", ...','shopfront-ecommerce'),
		'section' => 'shopfront_ecommerce_blog_post_settings'
	)); 

    // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('shopfront_ecommerce_sidebar_post_layout',array(
		'default' => 'right',
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('shopfront_ecommerce_sidebar_post_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Post Sidebar Position', 'shopfront-ecommerce'),
		'description'   => __('This option work for blog page, archive page and search page.', 'shopfront-ecommerce'),
		'section' => 'shopfront_ecommerce_blog_post_settings',
		'choices' => array(
			'left' => __('Left','shopfront-ecommerce'),
			'right' => __('Right','shopfront-ecommerce'),
			'three-column' => __('Three Columns','shopfront-ecommerce'),
			'four-column' => __('Four Columns','shopfront-ecommerce'),
			'grid' => __('Grid Layout','shopfront-ecommerce'),
			'full' => __('No Sidebar','shopfront-ecommerce'),
     ),
	) );

	$wp_customize->add_setting('shopfront_ecommerce_blog_post_description_option',array(
    	'default'   => 'Full Content', 
        'sanitize_callback' => 'shopfront_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('shopfront_ecommerce_blog_post_description_option',array(
        'type' => 'radio',
        'label' => __('Post Description Length','shopfront-ecommerce'),
        'section' => 'shopfront_ecommerce_blog_post_settings',
        'choices' => array(
            'No Content' => __('No Content','shopfront-ecommerce'),
            'Excerpt Content' => __('Excerpt Content','shopfront-ecommerce'),
            'Full Content' => __('Full Content','shopfront-ecommerce'),
        ),
	) );

	$wp_customize->add_setting('shopfront_ecommerce_blog_post_thumb',array(
        'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('shopfront_ecommerce_blog_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Show / Hide Blog Post Thumbnail', 'shopfront-ecommerce'),
        'section'     => 'shopfront_ecommerce_blog_post_settings',
    ));

    $wp_customize->add_setting( 'shopfront_ecommerce_blog_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'shopfront_ecommerce_sanitize_integer'
    ));
    $wp_customize->add_control(new shopfront_ecommerce_Slider_Custom_Control( $wp_customize, 'shopfront_ecommerce_blog_post_page_image_box_shadow',array(
		'label'	=> esc_html__('Blog Page Image Box Shadow','shopfront-ecommerce'),
		'section'=> 'shopfront_ecommerce_blog_post_settings',
		'settings'=>'shopfront_ecommerce_blog_post_page_image_box_shadow',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting( 'shopfront_ecommerce_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('shopfront_ecommerce_post_settings_upgraded_features', array(
		  'type'=> 'hidden',
		  'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			  <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-theme') ." '>Upgrade to Pro</a></span>",
		  'section' => 'shopfront_ecommerce_blog_post_settings'
	));

	//Single Post Settings
	$wp_customize->add_section('shopfront_ecommerce_single_post_settings',array(
		'title' => __('Manage Single Post Section', 'shopfront-ecommerce'),
		'priority' => null,
		'panel' => 'shopfront_ecommerce_panel_area'
	));

	$wp_customize->add_setting( 'shopfront_ecommerce_single_page_breadcrumb',array(
		'default' => true,
        'sanitize_callback'	=> 'shopfront_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('shopfront_ecommerce_single_page_breadcrumb',array(
       'section' => 'shopfront_ecommerce_single_post_settings',
	   'label' => __( 'Check To Enable Breadcrumb','shopfront-ecommerce' ),
	   'type' => 'checkbox'
    ));	

	$wp_customize->add_setting('shopfront_ecommerce_single_post_date',array(
		'default' => true,
		'sanitize_callback'	=> 'shopfront_ecommerce_sanitize_checkbox'
	));
	$wp_customize->add_control('shopfront_ecommerce_single_post_date',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Date ','shopfront-ecommerce'),
		'section' => 'shopfront_ecommerce_single_post_settings'
	));	

	$wp_customize->add_setting('shopfront_ecommerce_single_post_author',array(
		'default' => true,
		'sanitize_callback'	=> 'shopfront_ecommerce_sanitize_checkbox'
	));
	$wp_customize->add_control('shopfront_ecommerce_single_post_author',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Author','shopfront-ecommerce'),
		'section' => 'shopfront_ecommerce_single_post_settings'
	));

	$wp_customize->add_setting('shopfront_ecommerce_single_post_comment',array(
		'default' => true,
		'sanitize_callback'	=> 'shopfront_ecommerce_sanitize_checkbox'
	));
	$wp_customize->add_control('shopfront_ecommerce_single_post_comment',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Comments','shopfront-ecommerce'),
		'section' => 'shopfront_ecommerce_single_post_settings'
	));	

	$wp_customize->add_setting('shopfront_ecommerce_single_post_time',array(
		'default' => true,
		'sanitize_callback'	=> 'shopfront_ecommerce_sanitize_checkbox'
	));
	$wp_customize->add_control('shopfront_ecommerce_single_post_time',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Time','shopfront-ecommerce'),
		'section' => 'shopfront_ecommerce_single_post_settings'
	));	

	$wp_customize->add_setting('shopfront_ecommerce_single_post_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('shopfront_ecommerce_single_post_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','shopfront-ecommerce'),
		'description' => __('Ex: "/", "|", "-", ...','shopfront-ecommerce'),
		'section' => 'shopfront_ecommerce_single_post_settings'
	)); 

	$wp_customize->add_setting('shopfront_ecommerce_sidebar_single_post_layout',array(
    	'default' => 'right',
    	 'sanitize_callback' => 'shopfront_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('shopfront_ecommerce_sidebar_single_post_layout',array(
   		'type' => 'radio',
    	'label'     => __('Single post sidebar layout', 'shopfront-ecommerce'),
     	'section' => 'shopfront_ecommerce_single_post_settings',
     	'choices' => array(
			'left' => __('Left','shopfront-ecommerce'),
			'right' => __('Right','shopfront-ecommerce'),
			'full' => __('No Sidebar','shopfront-ecommerce')
     ),
	));

	$wp_customize->add_setting( 'shopfront_ecommerce_single_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('shopfront_ecommerce_single_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-theme') ." '>Upgrade to Pro</a></span>",
		'section' => 'shopfront_ecommerce_single_post_settings'
	)); 
	
	// Footer Section 
	$wp_customize->add_section('shopfront_ecommerce_footer', array(
		'title'	=> __('Mange Footer Section','shopfront-ecommerce'),
        'description' => __('<p class="sec-title">Manage Footer Section</p>','shopfront-ecommerce'),
		'priority'	=> null,
		'panel' => 'shopfront_ecommerce_panel_area',
	));

	$wp_customize->add_setting('shopfront_ecommerce_footer_widget', array(
	    'default' => true,
	    'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('shopfront_ecommerce_footer_widget', array(
	    'settings' => 'shopfront_ecommerce_footer_widget', // Corrected setting name
	    'section'   => 'shopfront_ecommerce_footer',
	    'label'     => __('Check to Enable Footer Widget', 'shopfront-ecommerce'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('shopfront_ecommerce_footer_bg_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'shopfront_ecommerce_footer_bg_color', array(
        'label'    => __('Footer Background Color', 'shopfront-ecommerce'),
        'section'  => 'shopfront_ecommerce_footer',
    )));

	$wp_customize->add_setting('shopfront_ecommerce_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'shopfront_ecommerce_footer_bg_image',array(
        'label' => __('Footer Background Image','shopfront-ecommerce'),
        'section' => 'shopfront_ecommerce_footer',
    )));

	$wp_customize->add_setting('shopfront_ecommerce_copyright_line',array(
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'shopfront_ecommerce_copyright_line', array(
	   'section' 	=> 'shopfront_ecommerce_footer',
	   'label'	 	=> __('Copyright Line','shopfront-ecommerce'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

    $wp_customize->add_setting('shopfront_ecommerce_copyright_link',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'shopfront_ecommerce_copyright_link', array(
	   'section' 	=> 'shopfront_ecommerce_footer',
	   'label'	 	=> __('Copyright Link','shopfront-ecommerce'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	//  footer bg color
	$wp_customize->add_setting('shopfront_ecommerce_footer_bg_color',array(
		'default' => '',
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_footer_bg_color', array(
		'settings' => 'shopfront_ecommerce_footer_bg_color',
		'section'   => 'shopfront_ecommerce_footer',
		'label' => __('BG Color', 'shopfront-ecommerce'),
		'type'      => 'color'
	));

	//  footer coypright color
	$wp_customize->add_setting('shopfront_ecommerce_footercoypright_color',array(
		'default' => '',
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_footercoypright_color', array(
	   'settings' => 'shopfront_ecommerce_footercoypright_color',
	   'section'   => 'shopfront_ecommerce_footer',
	   'label' => __('Coypright Color', 'shopfront-ecommerce'),
	   'type'      => 'color'
	));

	//  footer title color
	$wp_customize->add_setting('shopfront_ecommerce_footertitle_color',array(
		'default' => '',
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_footertitle_color', array(
	   'settings' => 'shopfront_ecommerce_footertitle_color',
	   'section'   => 'shopfront_ecommerce_footer',
	   'label' => __('Title Color', 'shopfront-ecommerce'),
	   'type'      => 'color'
	));

	//  footer description color
	$wp_customize->add_setting('shopfront_ecommerce_footerdescription_color',array(
		'default' => '',
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_footerdescription_color', array(
	   'settings' => 'shopfront_ecommerce_footerdescription_color',
	   'section'   => 'shopfront_ecommerce_footer',
	   'label' => __('Description Color', 'shopfront-ecommerce'),
	   'type'      => 'color'
	));

	//  footer list color
	$wp_customize->add_setting('shopfront_ecommerce_footerlist_color',array(
		'default' => '',
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_footerlist_color', array(
	   'settings' => 'shopfront_ecommerce_footerlist_color',
	   'section'   => 'shopfront_ecommerce_footer',
	   'label' => __('List Color', 'shopfront-ecommerce'),
	   'type'      => 'color'
	));

    $wp_customize->add_setting('shopfront_ecommerce_scroll_hide', array(
        'default' => true,
        'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'shopfront_ecommerce_scroll_hide',array(
        'label'          => __( 'Check To Show Scroll To Top', 'shopfront-ecommerce' ),
        'section'        => 'shopfront_ecommerce_footer',
        'settings'       => 'shopfront_ecommerce_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('shopfront_ecommerce_scroll_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'shopfront_ecommerce_sanitize_choices'
    ));
    $wp_customize->add_control('shopfront_ecommerce_scroll_position',array(
        'type' => 'radio',
        'section' => 'shopfront_ecommerce_footer',
        'label'	 	=> __('Scroll To Top Positions','shopfront-ecommerce'),
        'choices' => array(
            'Right' => __('Right','shopfront-ecommerce'),
            'Left' => __('Left','shopfront-ecommerce'),
            'Center' => __('Center','shopfront-ecommerce')
        ),
    ) );

	$wp_customize->add_setting('shopfront_ecommerce_scroll_text',array(
		'default'	=> __('TOP','shopfront-ecommerce'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('shopfront_ecommerce_scroll_text',array(
		'label'	=> __('Scroll To Top Button Text','shopfront-ecommerce'),
		'section'	=> 'shopfront_ecommerce_footer',
		'type'		=> 'text'
	));

	$wp_customize->add_setting( 'shopfront_ecommerce_scroll_top_shape', array(
		'default'           => 'circle',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_scroll_top_shape', array(
		'label'    => __( 'Scroll to Top Button Shape', 'shopfront-ecommerce' ),
		'section'  => 'shopfront_ecommerce_footer',
		'settings' => 'shopfront_ecommerce_scroll_top_shape',
		'type'     => 'radio',
		'choices'  => array(
			'box'        => __( 'Box', 'shopfront-ecommerce' ),
			'curved' => __( 'Curved', 'shopfront-ecommerce'),
			'circle'     => __( 'Circle', 'shopfront-ecommerce' ),
		),
	));

	$wp_customize->add_setting('shopfront_ecommerce_footer_widget_areas',array(
		'default'           => 4,
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_choices',
	));
	$wp_customize->add_control('shopfront_ecommerce_footer_widget_areas',array(
		'type'        => 'radio',
		'section' => 'shopfront_ecommerce_footer',
		'label'       => __('Footer widget area', 'shopfront-ecommerce'),
		'choices' => array(
		   '1'     => __('One', 'shopfront-ecommerce'),
		   '2'     => __('Two', 'shopfront-ecommerce'),
		   '3'     => __('Three', 'shopfront-ecommerce'),
		   '4'     => __('Four', 'shopfront-ecommerce')
		),
	));

    $wp_customize->add_setting( 'shopfront_ecommerce_footer_settings_upgraded_features',array(
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('shopfront_ecommerce_footer_settings_upgraded_features', array(
	    'type'=> 'hidden',
	    'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	        <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/wordpress-ecommerce-theme') ." '>Upgrade to Pro</a></span>",
	    'section' => 'shopfront_ecommerce_footer'
	));

    // Google Fonts
    $wp_customize->add_section( 'shopfront_ecommerce_google_fonts_section', array(
		'title'       => __( 'Google Fonts', 'shopfront-ecommerce' ),
		'priority'    => 24,
	) );

	$font_choices = array(
		'Kaushan Script:' => 'Kaushan Script',
		'Emilys Candy:' => 'Emilys Candy',
		'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i:' => 'Montserrat',
		'Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900' => 'Poppins',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);

	$wp_customize->add_setting( 'shopfront_ecommerce_headings_fonts', array(
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_fonts',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'shopfront-ecommerce'),
		'section' => 'shopfront_ecommerce_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'shopfront_ecommerce_body_fonts', array(
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_fonts'
	));
	$wp_customize->add_control( 'shopfront_ecommerce_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'shopfront-ecommerce' ),
		'section' => 'shopfront_ecommerce_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting('shopfront_ecommerce_woocommerce_sidebar_shop',array(
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_woocommerce_sidebar_shop', array(
	   'section'   => 'woocommerce_product_catalog',
	   'description'  => __('Click on the check box to remove sidebar from shop page.','shopfront-ecommerce'),
	   'label'	=> __('Shop Page Sidebar layout','shopfront-ecommerce'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('shopfront_ecommerce_woocommerce_sidebar_product',array(
		'sanitize_callback' => 'shopfront_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control( 'shopfront_ecommerce_woocommerce_sidebar_product', array(
	   'section'   => 'woocommerce_product_catalog',
	   'description'  => __('Click on the check box to remove sidebar from product page.','shopfront-ecommerce'),
	   'label'	=> __('Product Page Sidebar layout','shopfront-ecommerce'),
	   'type'      => 'checkbox'
 	));
}
add_action( 'customize_register', 'shopfront_ecommerce_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function shopfront_ecommerce_customize_preview_js() {
	wp_enqueue_script( 'shopfront_ecommerce_customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'shopfront_ecommerce_customize_preview_js' );