<?php

$shopfront_ecommerce_first_color = get_theme_mod('shopfront_ecommerce_first_color');
$shopfront_ecommerce_second_color = get_theme_mod('shopfront_ecommerce_second_color');
$shopfront_ecommerce_color_scheme_css = '';

/*------------------ Global First Color -----------*/

if ($shopfront_ecommerce_first_color) {
    $shopfront_ecommerce_color_scheme_css .= ':root {';
    $shopfront_ecommerce_color_scheme_css .= '--first-theme-color: ' . esc_attr($shopfront_ecommerce_first_color) . ' !important;';
    $shopfront_ecommerce_color_scheme_css .= '} ';
}
  
/*------------------ Global Second Color -----------*/
  
if ($shopfront_ecommerce_second_color) {
    $shopfront_ecommerce_color_scheme_css .= ':root {';
    $shopfront_ecommerce_color_scheme_css .= '--second-theme-color: ' . esc_attr($shopfront_ecommerce_second_color) . ' !important;';
    $shopfront_ecommerce_color_scheme_css .= '} ';
}

//---------------------------------Logo-Max-height--------- 
$shopfront_ecommerce_logo_width = get_theme_mod('shopfront_ecommerce_logo_width');

if($shopfront_ecommerce_logo_width != false){

$shopfront_ecommerce_color_scheme_css .='.logo img{';

    $shopfront_ecommerce_color_scheme_css .='width: '.esc_html($shopfront_ecommerce_logo_width).'px;';

$shopfront_ecommerce_color_scheme_css .='}';
}

/*---------------------------Slider Height ------------*/

$shopfront_ecommerce_slider_img_height = get_theme_mod('shopfront_ecommerce_slider_img_height');
if($shopfront_ecommerce_slider_img_height != false){
    $shopfront_ecommerce_color_scheme_css .='.slidesection img{';
        $shopfront_ecommerce_color_scheme_css .='height: '.esc_attr($shopfront_ecommerce_slider_img_height).' !important;';
    $shopfront_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Footer background image -------------------*/

$shopfront_ecommerce_footer_bg_image = get_theme_mod('shopfront_ecommerce_footer_bg_image');
if($shopfront_ecommerce_footer_bg_image != false){
    $shopfront_ecommerce_color_scheme_css .='.footer-widget{';
        $shopfront_ecommerce_color_scheme_css .='background: url('.esc_attr($shopfront_ecommerce_footer_bg_image).')!important;';
    $shopfront_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Footer Background Color -------------------*/

$shopfront_ecommerce_footer_bg_color = get_theme_mod('shopfront_ecommerce_footer_bg_color');
if($shopfront_ecommerce_footer_bg_color != false){
    $shopfront_ecommerce_color_scheme_css .='.footer-widget{';
        $shopfront_ecommerce_color_scheme_css .='background-color: '.esc_attr($shopfront_ecommerce_footer_bg_color).' !important;';
    $shopfront_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Scroll to top positions -------------------*/

$shopfront_ecommerce_scroll_position = get_theme_mod( 'shopfront_ecommerce_scroll_position','Right');
if($shopfront_ecommerce_scroll_position == 'Right'){
    $shopfront_ecommerce_color_scheme_css .='#button{';
        $shopfront_ecommerce_color_scheme_css .='right: 20px;';
    $shopfront_ecommerce_color_scheme_css .='}';
}else if($shopfront_ecommerce_scroll_position == 'Left'){
    $shopfront_ecommerce_color_scheme_css .='#button{';
        $shopfront_ecommerce_color_scheme_css .='left: 20px;';
    $shopfront_ecommerce_color_scheme_css .='}';
}else if($shopfront_ecommerce_scroll_position == 'Center'){
    $shopfront_ecommerce_color_scheme_css .='#button{';
        $shopfront_ecommerce_color_scheme_css .='right: 50%;left: 50%;';
    $shopfront_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Blog Post Page Image Box Shadow -------------------*/

$shopfront_ecommerce_blog_post_page_image_box_shadow = get_theme_mod('shopfront_ecommerce_blog_post_page_image_box_shadow',0);
if($shopfront_ecommerce_blog_post_page_image_box_shadow != false){
    $shopfront_ecommerce_color_scheme_css .='.post-thumb img{';
        $shopfront_ecommerce_color_scheme_css .='box-shadow: '.esc_attr($shopfront_ecommerce_blog_post_page_image_box_shadow).'px '.esc_attr($shopfront_ecommerce_blog_post_page_image_box_shadow).'px '.esc_attr($shopfront_ecommerce_blog_post_page_image_box_shadow).'px #cccccc;';
    $shopfront_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Woocommerce Product Image Border Radius -------------------*/

$shopfront_ecommerce_woo_product_img_border_radius = get_theme_mod('shopfront_ecommerce_woo_product_img_border_radius');
if($shopfront_ecommerce_woo_product_img_border_radius != false){
    $shopfront_ecommerce_color_scheme_css .='.woocommerce ul.products li.product a img{';
        $shopfront_ecommerce_color_scheme_css .='border-radius: '.esc_attr($shopfront_ecommerce_woo_product_img_border_radius).'px;';
    $shopfront_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Preloader Background Image ------------*/

$shopfront_ecommerce_preloader_bg_image = get_theme_mod('shopfront_ecommerce_preloader_bg_image');
if($shopfront_ecommerce_preloader_bg_image != false){
  $shopfront_ecommerce_color_scheme_css .='#preloader{';
    $shopfront_ecommerce_color_scheme_css .='background: url('.esc_attr($shopfront_ecommerce_preloader_bg_image).'); background-size: cover;';
  $shopfront_ecommerce_color_scheme_css .='}';
}

/*--------------------------- Scroll to Top Button Shape -------------------*/

$shopfront_ecommerce_scroll_top_shape = get_theme_mod('shopfront_ecommerce_scroll_top_shape', 'circle');
if($shopfront_ecommerce_scroll_top_shape == 'box' ){
    $shopfront_ecommerce_color_scheme_css .='#button{';
        $shopfront_ecommerce_color_scheme_css .=' border-radius: 0%';
    $shopfront_ecommerce_color_scheme_css .='}';
}elseif($shopfront_ecommerce_scroll_top_shape == 'curved' ){
    $shopfront_ecommerce_color_scheme_css .='#button{';
        $shopfront_ecommerce_color_scheme_css .=' border-radius: 20%';
    $shopfront_ecommerce_color_scheme_css .='}';
}elseif($shopfront_ecommerce_scroll_top_shape == 'circle' ){
    $shopfront_ecommerce_color_scheme_css .='#button{';
        $shopfront_ecommerce_color_scheme_css .=' border-radius: 50%;';
    $shopfront_ecommerce_color_scheme_css .='}';
}