<?php
/**
 * The Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Shopfront Ecommerce
 */

get_header(); ?>

<div id="content">
  <?php
    $shopfront_ecommerce_hidcatslide = get_theme_mod('shopfront_ecommerce_hide_categorysec', false);
    $shopfront_ecommerce_slidersection = get_theme_mod('shopfront_ecommerce_slidersection');

    if ($shopfront_ecommerce_hidcatslide && $shopfront_ecommerce_slidersection) { ?>
    <section id="catsliderarea">
      <div class="catwrapslider">
        <div class="owl-carousel">
          <?php if( get_theme_mod('shopfront_ecommerce_slidersection',false) ) { ?>
          <?php $queryvar = new WP_Query('cat='.esc_attr(get_theme_mod('shopfront_ecommerce_slidersection',false)));
            while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>
              <div class="slidesection"> 
                <?php if(has_post_thumbnail()){
                  the_post_thumbnail('full');
                  } else{?>
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slider.png" alt="<?php echo esc_attr( 'slider', 'shopfront-ecommerce'); ?>"/>
                <?php } ?>
                <div class="slider-box">
                  <h1><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title(); ?></a></h1>
                  <div class="shop-now">
                    <?php 
                    $shopfront_ecommerce_button_text = get_theme_mod('shopfront_ecommerce_button_text', 'SHOP NOW');
                    $shopfront_ecommerce_button_link_slider = get_theme_mod('shopfront_ecommerce_button_link_slider', ''); 
                    if (empty($shopfront_ecommerce_button_link_slider)) {
                        $shopfront_ecommerce_button_link_slider = get_permalink();
                    }
                    if ($shopfront_ecommerce_button_text || !empty($shopfront_ecommerce_button_link_slider)) { ?>
                      <a href="<?php echo esc_url($shopfront_ecommerce_button_link_slider); ?>" class="button redmor">
                        <?php echo esc_html($shopfront_ecommerce_button_text); ?>
                          <span class="screen-reader-text"><?php echo esc_html($shopfront_ecommerce_button_text); ?></span>
                      </a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php } ?>
        </div>
      </div>
      <div class="clear"></div>
    </section>
  <?php } ?>

<?php
  $shopfront_ecommerce_procat_show = get_theme_mod('shopfront_ecommerce_procat_show', false);
  if ($shopfront_ecommerce_procat_show != "") { ?>
    <section id="product_cat_slider" class="my-5">
      <div class="container">
        <?php if (class_exists('woocommerce')) { ?>
          <?php
          $shopfront_ecommerce_prod_categories = get_terms('product_cat', array(
            'number'     => get_theme_mod('shopfront_ecommerce_product_category_number'),
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => 0
          ));
          $column_counter = 0;
          foreach ($shopfront_ecommerce_prod_categories as $shopfront_ecommerce_prod_cat) :
            $shopfront_ecommerce_cat_thumb_id = get_term_meta($shopfront_ecommerce_prod_cat->term_id, 'thumbnail_id', true);
            $shopfront_ecommerce_cat_thumb_url = wp_get_attachment_url($shopfront_ecommerce_cat_thumb_id);
            $shopfront_ecommerce_term_link = get_term_link($shopfront_ecommerce_prod_cat, 'product_cat');
            ?>
            <?php if ($column_counter % 4 === 0) : ?>
              <div class="row">
            <?php endif; ?>
            <div class="col-lg-3 col-md-6 my-5">
              <div class="product_cat_box text-center">
                <a href="<?php echo esc_url($shopfront_ecommerce_term_link); ?>"><img src="<?php echo esc_url($shopfront_ecommerce_cat_thumb_url); ?>" alt="<?php echo esc_attr($shopfront_ecommerce_prod_cat->name); ?>" /></a>
                <a href="<?php echo esc_url($shopfront_ecommerce_term_link); ?>"><h3 class="pt-3"><?php echo esc_html($shopfront_ecommerce_prod_cat->name); ?></h3></a>
              </div>
            </div>
            <?php if ($column_counter % 4 === 3) : ?>
              </div><!-- .row -->
            <?php endif; ?>
            <?php $column_counter++; ?>
          <?php endforeach;
          if ($column_counter % 4 !== 0) {
            echo '</div><!-- .row -->';
          }
          wp_reset_query();
          ?>
        <?php } ?>
      </div>
    </section>
  <?php } ?>
</div>

<?php get_footer(); ?>