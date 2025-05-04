<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Shopfront Ecommerce
 */
?>
<div id="footer">
  <?php 
    $shopfront_ecommerce_footer_widget_enabled = get_theme_mod('shopfront_ecommerce_footer_widget', true);
    
    if ($shopfront_ecommerce_footer_widget_enabled !== false && $shopfront_ecommerce_footer_widget_enabled !== '') { ?>

    <?php 
        $shopfront_ecommerce_widget_areas = get_theme_mod('shopfront_ecommerce_footer_widget_areas', '4');
        if ($shopfront_ecommerce_widget_areas == '3') {
            $shopfront_ecommerce_cols = 'col-lg-4 col-md-6';
        } elseif ($shopfront_ecommerce_widget_areas == '4') {
            $shopfront_ecommerce_cols = 'col-lg-3 col-md-6';
        } elseif ($shopfront_ecommerce_widget_areas == '2') {
            $shopfront_ecommerce_cols = 'col-lg-6 col-md-6';
        } else {
            $shopfront_ecommerce_cols = 'col-lg-12 col-md-12';
        }
    ?>

    <div class="footer-widget">
        <div class="container">
          <div class="row">
            <!-- Footer 1 -->
            <div class="<?php echo esc_attr($shopfront_ecommerce_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else : ?>
                    <aside id="categories" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer1', 'shopfront-ecommerce'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Categories', 'shopfront-ecommerce'); ?></h3>
                        <ul>
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 2 -->
            <div class="<?php echo esc_attr($shopfront_ecommerce_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php else : ?>
                    <aside id="archives" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer2', 'shopfront-ecommerce'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Archives', 'shopfront-ecommerce'); ?></h3>
                        <ul>
                            <?php wp_get_archives(array('type' => 'monthly')); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 3 -->
            <div class="<?php echo esc_attr($shopfront_ecommerce_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <aside id="meta" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer3', 'shopfront-ecommerce'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Meta', 'shopfront-ecommerce'); ?></h3>
                        <ul>
                            <?php wp_register(); ?>
                            <li><?php wp_loginout(); ?></li>
                            <?php wp_meta(); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 4 -->
            <div class="<?php echo esc_attr($shopfront_ecommerce_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-4')) : ?>
                    <?php dynamic_sidebar('footer-4'); ?>
                <?php else : ?>
                    <aside id="search-widget" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer4', 'shopfront-ecommerce'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Search', 'shopfront-ecommerce'); ?></h3>
                        <?php the_widget('WP_Widget_Search'); ?>
                    </aside>
                <?php endif; ?>
            </div>
          </div>
        </div>
    </div>

  <?php } ?>
  <div class="clear"></div> 

  <div class="copywrap">
  	<div class="container">
      <p><a href="<?php echo esc_html(get_theme_mod('shopfront_ecommerce_copyright_link',__('https://www.theclassictemplates.com/products/free-ecommerce-wordpress-theme','shopfront-ecommerce'))); ?>" target="_blank"><?php echo esc_html(get_theme_mod('shopfront_ecommerce_copyright_line',__('Shopfront Ecommerce WordPress Theme','shopfront-ecommerce'))); ?></a> <?php echo esc_html('By Classic Templates','shopfront-ecommerce'); ?></p>
    </div>
  </div>
</div>

<?php if(get_theme_mod('shopfront_ecommerce_scroll_hide',true)){ ?>
    <a id="button"><?php echo esc_html( get_theme_mod('shopfront_ecommerce_scroll_text',__('TOP', 'shopfront-ecommerce' )) ); ?></a>
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>