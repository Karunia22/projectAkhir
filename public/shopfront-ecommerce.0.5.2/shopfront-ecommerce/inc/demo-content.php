<div class="theme-offer">
    <?php

    // POST and update the customizer and other related data of Shopfront Ecommerce
    if ( isset( $_POST['submit'] ) ) {

        // WooCommerce installation and activation
        if (!is_plugin_active('woocommerce/woocommerce.php')) {
            $shopfront_ecommerce_plugin_slug = 'woocommerce';
            $shopfront_ecommerce_plugin_file = 'woocommerce/woocommerce.php';
            $shopfront_ecommerce_installed_plugins = get_plugins();
            if (!isset($shopfront_ecommerce_installed_plugins[$shopfront_ecommerce_plugin_file])) {
                include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
                include_once(ABSPATH . 'wp-admin/includes/file.php');
                include_once(ABSPATH . 'wp-admin/includes/misc.php');
                include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
                $shopfront_ecommerce_upgrader = new Plugin_Upgrader();
                $shopfront_ecommerce_upgrader->install('https://downloads.wordpress.org/plugin/woocommerce.latest-stable.zip');
            }
            activate_plugin($shopfront_ecommerce_plugin_file);
        }

        // ------- Create Main Menu --------
        $shopfront_ecommerce_menuname = 'Primary Menu';
        $shopfront_ecommerce_bpmenulocation = 'primary';
        $shopfront_ecommerce_menu_exists = wp_get_nav_menu_object( $shopfront_ecommerce_menuname );
    
        if ( !$shopfront_ecommerce_menu_exists ) {
            $shopfront_ecommerce_menu_id = wp_create_nav_menu( $shopfront_ecommerce_menuname );

            // Create Home Page
            $shopfront_ecommerce_home_title = 'Home';
            $shopfront_ecommerce_home = array(
                'post_type'    => 'page',
                'post_title'   => $shopfront_ecommerce_home_title,
                'post_content' => '',
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => 'home'
            );
            $shopfront_ecommerce_home_id = wp_insert_post($shopfront_ecommerce_home);
            // Assign Home Page Template
            add_post_meta($shopfront_ecommerce_home_id, '_wp_page_template', '/template-home-page.php');
            // Update options to set Home Page as the front page
            update_option('page_on_front', $shopfront_ecommerce_home_id);
            update_option('show_on_front', 'page');
            // Add Home Page to Menu
            wp_update_nav_menu_item($shopfront_ecommerce_menu_id, 0, array(
                'menu-item-title' => __('Home', 'shopfront-ecommerce'),
                'menu-item-classes' => 'home',
                'menu-item-url' => home_url('/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $shopfront_ecommerce_home_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Create a new Page 
            $shopfront_ecommerce_pages_title = 'Pages';
            $shopfront_ecommerce_pages_content = '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>';
            $shopfront_ecommerce_pages = array(
                'post_type'    => 'page',
                'post_title'   => $shopfront_ecommerce_pages_title,
                'post_content' => $shopfront_ecommerce_pages_content,
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => 'pages'
            );
            $shopfront_ecommerce_pages_id = wp_insert_post($shopfront_ecommerce_pages);
            // Add Pages Page to Menu
            wp_update_nav_menu_item($shopfront_ecommerce_menu_id, 0, array(
                'menu-item-title' => __('Pages', 'shopfront-ecommerce'),
                'menu-item-classes' => 'pages',
                'menu-item-url' => home_url('/pages/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $shopfront_ecommerce_pages_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Create About Us Page 
            $shopfront_ecommerce_about_title = 'About Us';
            $shopfront_ecommerce_about_content = '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>';
            $shopfront_ecommerce_about = array(
                'post_type'    => 'page',
                'post_title'   => $shopfront_ecommerce_about_title,
                'post_content' => $shopfront_ecommerce_about_content,
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => 'about-us'
            );
            $shopfront_ecommerce_about_id = wp_insert_post($shopfront_ecommerce_about);
            // Add About Us Page to Menu
            wp_update_nav_menu_item($shopfront_ecommerce_menu_id, 0, array(
                'menu-item-title' => __('About Us', 'shopfront-ecommerce'),
                'menu-item-classes' => 'about-us',
                'menu-item-url' => home_url('/about-us/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $shopfront_ecommerce_about_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Assign the menu to the primary location if not already set
            if ( ! has_nav_menu( $shopfront_ecommerce_bpmenulocation ) ) {
                $shopfront_ecommerce_locations = get_theme_mod( 'nav_menu_locations' );
                if ( empty( $shopfront_ecommerce_locations ) ) {
                    $shopfront_ecommerce_locations = array();
                }
                $shopfront_ecommerce_locations[ $shopfront_ecommerce_bpmenulocation ] = $shopfront_ecommerce_menu_id;
                set_theme_mod( 'nav_menu_locations', $shopfront_ecommerce_locations );
            }
        }

        //Header Section
        set_theme_mod( 'shopfront_ecommerce_the_custom_logo', esc_url( get_template_directory_uri().'/images/Logo.png'));
        set_theme_mod( 'shopfront_ecommerce_offer_text', 'WELCOME TO ECOMMERCE WORDPRESS THEME' );
        set_theme_mod( 'shopfront_ecommerce_category_text', 'CATEGORIES' );
        set_theme_mod( 'shopfront_ecommerce_product_category_number', '7' );

        //Social Media Section
        set_theme_mod( 'shopfront_ecommerce_fb_link', '#' );
        set_theme_mod( 'shopfront_ecommerce_twitt_link', '#' );
        set_theme_mod( 'shopfront_ecommerce_linked_link', '#' );
        set_theme_mod( 'shopfront_ecommerce_insta_link', '#' );
        set_theme_mod( 'shopfront_ecommerce_whatsapp_link', '#' );

       //Slider Section
       set_theme_mod( 'shopfront_ecommerce_hide_categorysec', true );
       set_theme_mod( 'shopfront_ecommerce_button_text', 'SHOP NOW' );
       set_theme_mod( 'shopfront_ecommerce_button_link_slider', '#' );

        // Create the 'Shopfront' category and retrieve its ID
        $shopfront_ecommerce_slider_category_id = wp_create_category('Shopfront');

        // Set the category in theme mods for the slider section
        if (!is_wp_error($shopfront_ecommerce_slider_category_id)) {
            set_theme_mod('shopfront_ecommerce_slidersection', $shopfront_ecommerce_slider_category_id); 
        }
        
        $shopfront_ecommerce_titles = array(
            'Ecommerce Solution For Starting Online Shop', 
            'Launch Your Dream Store with Ecommerce Solution', 
            'Sell Anything, Anywhere with Powerful Ecommerce'
        );             
        // Create three demo posts and assign them to the 'Shopfront' category
        for ($shopfront_ecommerce_i = 1; $shopfront_ecommerce_i <= 3; $shopfront_ecommerce_i++) {
            $title_index = $shopfront_ecommerce_i - 1; // Adjust for zero-based array indexing
            set_theme_mod('shopfront_ecommerce_title' . $shopfront_ecommerce_i, $shopfront_ecommerce_titles[$title_index]);
        
            // Prepare the post object
            $shopfront_ecommerce_my_post = array(
                'post_title'  => wp_strip_all_tags($shopfront_ecommerce_titles[$title_index]),
                'post_status' => 'publish',
                'post_type'   => 'post',
                'tax_input'   => array('category' => array($shopfront_ecommerce_slider_category_id)), // Assign category correctly
            );
        
            // Insert the post into the database
            $shopfront_ecommerce_post_id = wp_insert_post($shopfront_ecommerce_my_post);
        
            // If the post was successfully created, set the featured image
            if (!is_wp_error($shopfront_ecommerce_post_id)) {
                $shopfront_ecommerce_image_url = get_template_directory_uri() . '/images/slider' . $shopfront_ecommerce_i . '.png';
        
                // Download and set the image as a featured image
                $shopfront_ecommerce_image_id = media_sideload_image($shopfront_ecommerce_image_url, $shopfront_ecommerce_post_id, null, 'id');
                if (!is_wp_error($shopfront_ecommerce_image_id)) {
                    set_post_thumbnail($shopfront_ecommerce_post_id, $shopfront_ecommerce_image_id);
                } else {
                    error_log('Failed to set post thumbnail for post ID: ' . $shopfront_ecommerce_post_id);
                }
            } else {
                error_log('Failed to create post: ' . print_r($shopfront_ecommerce_post_id, true));
            }
        }
        
        // Category Section
        set_theme_mod( 'shopfront_ecommerce_procat_show', true );
        $shopfront_ecommerce_category_data = [
            'MEN COLLECTION' => get_template_directory_uri() . '/images/shopfront-products/shopfront-product1.png',
            'WOMEN COLLECTION' => get_template_directory_uri() . '/images/shopfront-products/shopfront-product2.png',
            'WATCH COLLECTION' => get_template_directory_uri() . '/images/shopfront-products/shopfront-product3.png',
            'BAG COLLECTION' => get_template_directory_uri() . '/images/shopfront-products/shopfront-product4.png',
        ];

        // Default image for Uncategorized
        $shopfront_ecommerce_default_image_url = get_template_directory_uri() . '/images/slider.png';

        // Function to upload image and get attachment ID
        function shopfront_ecommerce_upload_image($image_url, $image_name) {
            $upload_dir = wp_upload_dir();
            $response = wp_remote_get($image_url);

            if (is_wp_error($response)) {
                error_log('Error fetching image: ' . $response->get_error_message());
                return false;
            }

            $image_data = wp_remote_retrieve_body($response);
            if (empty($image_data)) {
                error_log('Image data is empty for URL: ' . $image_url);
                return false;
            }

            $file_path = $upload_dir['path'] . '/' . wp_unique_filename($upload_dir['path'], $image_name);
            global $wp_filesystem;
            WP_Filesystem();

            if (!$wp_filesystem->put_contents($file_path, $image_data)) {
                error_log('Failed to save the image to: ' . $file_path);
                return false;
            }

            $filetype = wp_check_filetype($file_path);
            $attachment = [
                'post_mime_type' => $filetype['type'],
                'post_title'     => sanitize_file_name($image_name),
                'post_content'   => '',
                'post_status'    => 'inherit',
            ];

            $attach_id = wp_insert_attachment($attachment, $file_path);
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
            wp_update_attachment_metadata($attach_id, $attach_data);

            return $attach_id;
        }

        // Process each category
        foreach ($shopfront_ecommerce_category_data as $category_name => $image_url) {
            $term = get_term_by('name', $category_name, 'product_cat');
            $term_id = $term ? $term->term_id : wp_create_term($category_name, 'product_cat')['term_id'];

            // Set category thumbnail
            $thumbnail_id = get_term_meta($term_id, 'thumbnail_id', true);
            if (!$thumbnail_id) {
                $image_name = sanitize_title($category_name) . '.png';
                $attach_id = shopfront_ecommerce_upload_image($image_url, $image_name);
                if ($attach_id) {
                    update_term_meta($term_id, 'thumbnail_id', $attach_id);
                }
            }

            // Add products to the category
            for ($i = 1; $i <= 3; $i++) {
                $product_name = "{$category_name} Product {$i}";
                $product_id = wp_insert_post([
                    'post_title'   => $product_name,
                    'post_content' => 'This is a sample product description.',
                    'post_status'  => 'publish',
                    'post_type'    => 'product',
                ]);

                if (!is_wp_error($product_id)) {
                    wp_set_object_terms($product_id, $category_name, 'product_cat');

                    // Set product image
                    $product_image_name = sanitize_title($product_name) . '.png';
                    $product_image_id = shopfront_ecommerce_upload_image($image_url, $product_image_name);

                    if ($product_image_id) {
                        set_post_thumbnail($product_id, $product_image_id);
                    }

                    // Mark as featured
                    update_post_meta($product_id, '_featured', 'yes');
                    
                    // Set price and stock status
                    update_post_meta($product_id, '_price', '49.99'); // Set price
                    update_post_meta($product_id, '_regular_price', '49.99');
                    update_post_meta($product_id, '_stock_status', 'instock');
                    update_post_meta($product_id, '_manage_stock', 'no');
                    
                    // Assign to "Uncategorized"
                    $uncategorized_term = get_term_by('name', 'Uncategorized', 'product_cat');
                    if ($uncategorized_term) {
                        wp_set_object_terms($product_id, 'Uncategorized', 'product_cat', true);
                    }
                }
            }
        }

        // Handle "Uncategorized" category image
        $uncategorized_term = get_term_by('name', 'Uncategorized', 'product_cat');
        if ($uncategorized_term) {
            $uncategorized_thumbnail_id = get_term_meta($uncategorized_term->term_id, 'thumbnail_id', true);
            if (!$uncategorized_thumbnail_id) {
                $uncategorized_attach_id = shopfront_ecommerce_upload_image($shopfront_ecommerce_default_image_url, 'slider.png');
                if ($uncategorized_attach_id) {
                    update_term_meta($uncategorized_term->term_id, 'thumbnail_id', $uncategorized_attach_id);
                }
            }
        }

        // Footer Copyright Text
        set_theme_mod('shopfront_ecommerce_copyright_line', 'Shopfront Ecommerce WordPress Theme');

        // Show success message and the "View Site" button
        echo '<div class="success">Demo Import Successful</div>';
    }
    ?>
    <ul>
        <li>
            <hr>
            <?php 
            if (!isset($_POST['submit'])) : ?>
                <!-- Show demo importer form only if it's not submitted -->
                <?php echo esc_html('Click on the below content to get demo content installed.', 'shopfront-ecommerce'); ?>
                <br>
                <small><b><?php echo esc_html('Please take a backup if your website is already live with data. This importer will overwrite existing data.', 'shopfront-ecommerce'); ?></b></small>
                <br><br>

                <form id="demo-importer-form" action="" method="POST" onsubmit="return confirm('Do you really want to do this?');">
                    <input type="submit" name="submit" value="<?php echo esc_attr('Run Importer', 'shopfront-ecommerce'); ?>" class="button button-primary button-large">
                </form>
            <?php 
            endif; 

            if (isset($_POST['submit'])) {
                echo '<div class="view-site-btn">';
                echo '<a href="' . esc_url(home_url()) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">View Site</a>';
                echo '</div>';
            }
            ?>
            <hr>
        </li>
    </ul>
</div>
