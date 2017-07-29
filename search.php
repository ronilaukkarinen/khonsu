<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package khonsu
 */

get_header();

get_template_part('template-parts/hero', get_post_type()); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">
    <div class="container container-search">

      <?php if ( have_posts() ) :
      $count = 0; ?>

      <div class="notification-box">
        <h3>Hakusi tulokset</h3>
        <p>Hakemallasi hakusanalla <i><?php echo get_search_query(); ?></i> löytyi yhteensä  <?php $allsearch = new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); echo $count; wp_reset_query(); ?> tulosta.</p>
      </div><!-- .notification-box -->

      <?php while ( have_posts() ) :
      the_post();
      get_template_part( 'template-parts/content' );
    endwhile;

    khonsu_pagination();

  else :
    get_template_part( 'template-parts/content', 'none' );
    endif; ?>

  </div><!-- .container -->

</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
