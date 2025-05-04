<?php
/*
 * @package Shopfront Ecommerce
 */

function shopfront_ecommerce_admin_enqueue_scripts() {
    wp_enqueue_style( 'shopfront-ecommerce-admin-style', esc_url( get_template_directory_uri() ).'/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'shopfront_ecommerce_admin_enqueue_scripts' );

add_action( 'admin_init', 'shopfront_ecommerce_options' );

function shopfront_ecommerce_options() {
    global $pagenow;

    if ( is_admin() && 'themes.php' === $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
        // Theme activated — future actions can go here, like setting theme mods or showing notices.
    }
}

function shopfront_ecommerce_theme_info_menu_link() {

    $shopfront_ecommerce_theme = wp_get_theme();
    add_theme_page(
        sprintf( esc_html__( 'Welcome to %1$s %2$s', 'shopfront-ecommerce' ), $shopfront_ecommerce_theme->get( 'Name' ), $shopfront_ecommerce_theme->get( 'Version' ) ),
        esc_html__( 'Theme Info', 'shopfront-ecommerce' ),'edit_theme_options','shopfront-ecommerce','shopfront_ecommerce_theme_info_page'
    );
    // Add "Theme Demo Import" page
    add_theme_page(
        esc_html__( 'Theme Demo Import', 'shopfront-ecommerce' ),
        esc_html__( 'Theme Demo Import', 'shopfront-ecommerce' ),
        'edit_theme_options',
        'shopfront-ecommerce-demo',
        'shopfront_ecommerce_demo_content_page'
    );
}
add_action( 'admin_menu', 'shopfront_ecommerce_theme_info_menu_link' );

function shopfront_ecommerce_theme_info_page() {

    $shopfront_ecommerce_theme = wp_get_theme();
    ?>
<div class="wrap theme-info-wrap">
    <h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'shopfront-ecommerce' ), esc_html($shopfront_ecommerce_theme->get( 'Name' )), esc_html($shopfront_ecommerce_theme->get( 'Version' ))); ?>
    </h1>
    <p class="theme-description">
    <?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'shopfront-ecommerce' ); ?>
    </p>
    <div class="important-link">
        <p class="main-box columns-wrapper clearfix">
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Pro version of our theme', 'shopfront-ecommerce' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you exited for our theme? Then we will proceed for pro version of theme.', 'shopfront-ecommerce' ); ?></p>
                <a class="get-premium" href="<?php echo esc_url( SHOPFRONT_ECOMMERCE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Go To Premium', 'shopfront-ecommerce' ); ?></a>
                <p><strong><?php esc_html_e( 'Check all classic features', 'shopfront-ecommerce' ); ?></strong></p>
                <p><?php esc_html_e( 'Explore all the premium features.', 'shopfront-ecommerce' ); ?></p>
                <a href="<?php echo esc_url( SHOPFRONT_ECOMMERCE_THEME_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'shopfront-ecommerce' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Need Help?', 'shopfront-ecommerce' ); ?></strong></p>
                <p><?php esc_html_e( 'Go to our support forum to help you out in case of queries and doubts regarding our theme.', 'shopfront-ecommerce' ); ?></p>
                <a href="<?php echo esc_url( SHOPFRONT_ECOMMERCE_SUPPORT ); ?>" target="_blank"><?php esc_html_e( 'Contact Us', 'shopfront-ecommerce' ); ?></a>
                <p><strong><?php esc_html_e( 'Leave us a review', 'shopfront-ecommerce' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you enjoying our theme? We would love to hear your feedback.', 'shopfront-ecommerce' ); ?></p>
                <a href="<?php echo esc_url( SHOPFRONT_ECOMMERCE_REVIEW ); ?>" target="_blank"><?php esc_html_e( 'Rate This Theme', 'shopfront-ecommerce' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Check Our Demo', 'shopfront-ecommerce' ); ?></strong></p>
                <p><?php esc_html_e( 'Here, you can view a live demonstration of our premium them.', 'shopfront-ecommerce' ); ?></p>
                <a href="<?php echo esc_url( SHOPFRONT_ECOMMERCE_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'Premium Demo', 'shopfront-ecommerce' ); ?></a>
                <p><strong><?php esc_html_e( 'Theme Documentation', 'shopfront-ecommerce' ); ?></strong></p>
                <p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed theme setup.', 'shopfront-ecommerce' ); ?></p>
                <a href="<?php echo esc_url( SHOPFRONT_ECOMMERCE_THEME_DOCUMENTATION ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'shopfront-ecommerce' ); ?></a>
            </div>
        </p>
    </div>
    <div id="getting-started">
        <h3><?php printf( esc_html__( 'Getting started with %s', 'shopfront-ecommerce' ),
        esc_html($shopfront_ecommerce_theme->get( 'Name' ))); ?></h3>
        <div class="columns-wrapper clearfix">
            <div class="column column-half clearfix">
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Description', 'shopfront-ecommerce' ); ?></h4>
                    <div class="theme-description-1"><?php echo esc_html($shopfront_ecommerce_theme->get( 'Description' )); ?></div>
                </div>
            </div>
            <div class="column column-half clearfix">
                <img src="<?php echo esc_url( $shopfront_ecommerce_theme->get_screenshot() ); ?>" alt="<?php echo esc_attr( 'screenshot', 'shopfront-ecommerce'); ?>"/>
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Options', 'shopfront-ecommerce' ); ?></h4>
                    <p class="about">
                    <?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'shopfront-ecommerce' ),esc_html($shopfront_ecommerce_theme->get( 'Name' ))); ?></p>
                    <p>
                    <div class="themelink-1">
                        <a target="_blank" href="<?php echo esc_url( wp_customize_url() ); ?>"><?php esc_html_e( 'Customize Theme', 'shopfront-ecommerce' ); ?></a>
                        <a href="<?php echo esc_url( SHOPFRONT_ECOMMERCE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Checkout Premium', 'shopfront-ecommerce' ); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="theme-author">
      <p><?php
        printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'shopfront-ecommerce' ),
            esc_html($shopfront_ecommerce_theme->get( 'Name' )),
            '<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'shopfront-ecommerce' ) . '">classictemplate</a>',
            '<a target="_blank" href="' . esc_url( SHOPFRONT_ECOMMERCE_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'shopfront-ecommerce' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'shopfront-ecommerce' ) . '</a>'
        );
        ?></p>
    </div>
</div>
<?php
}

function shopfront_ecommerce_demo_content_page() {

    $shopfront_ecommerce_theme = wp_get_theme();
    ?>
    <div class="container">
       <div class="start-box">
          <div class="columns-wrapper m-0"> 
             <div class="column column-half clearfix">
               <div class="wrapper-info"> 
                  <img src="<?php echo esc_url( get_template_directory_uri().'/images/Logo.png' ); ?>" />
                  <h2><?php esc_html_e( 'Welcome to Shopfront Ecommerce', 'shopfront-ecommerce' ); ?></h2>
                  <span class="version"><?php esc_html_e( 'Version', 'shopfront-ecommerce' ); ?>: <?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></span>	
                  <p><?php esc_html_e( 'To begin, locate the demo importer button and click on it to initiate the importation of all the demo content.', 'shopfront-ecommerce' ); ?></p>
                  <?php require get_parent_theme_file_path( '/inc/demo-content.php' ); ?>
               </div>
             </div>
             <div class="column column-half clearfix">
             <div class="get-screenshot">
               <img src="<?php echo esc_url( get_template_directory_uri().'/screenshot.png' ); ?>" />
             </div>   
             </div>
          </div>
       </div>
    </div>
<?php
}

?>
