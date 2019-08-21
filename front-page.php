<?php
/**
 * The template for displaying front page
 *
 * Contains the closing of the #content div and all content after.
 * Initial styles for front page template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package khonsu
 */

if ( is_front_page() && ! is_paged() ) :
  include( TEMPLATEPATH . '/inc/cache-start.php' );
endif;

get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main site-front-page<?php if ( is_paged() ) : ?> paged<?php endif; ?>">
    <div class="container">

      <?php
      if ( is_paged() ) :
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content' );
          endwhile;

          khonsu_pagination();

        else :
          get_template_part( 'template-parts/content', 'none' );
        endif;
      else :
        get_template_part( 'template-parts/block-four' );
        get_template_part( 'template-parts/upsell-posts' );
        get_template_part( 'template-parts/ads' );
        get_template_part( 'template-parts/block-three-most-popular' );
      ?>

        <div class="dynamic-random-posts">
          <?php get_template_part( 'template-parts/block-random' ); ?>
        </div>

        <?php
        get_template_part( 'template-parts/rss-feeds' );
      endif;
      ?>

    </div><!-- .container -->
  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();

if ( is_front_page() && ! is_paged() ) :
  include( TEMPLATEPATH . '/inc/cache-end.php' );
endif;
