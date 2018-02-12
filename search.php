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
        <h3><?php _e( 'Hakusi tulokset', 'khonsu' ); ?></h3>
        <p><?php _e( 'Hakemallasi hakusanalla', 'khonsu' ); ?> <i><?php echo get_search_query(); ?></i> <?php _e( 'löytyi yhteensä ', 'khonsu' ); $allsearch = new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); echo $count; wp_reset_query(); _e( ' tulosta.', 'khonsu' ); ?></p>
      </div><!-- .notification-box -->

      <?php while ( have_posts() ) :
      the_post();
      get_template_part( 'template-parts/content' );
    endwhile;

    khonsu_pagination();

  else : ?>

    <div class="notification-box">
      <h3><?php _e( 'Mitään ei löytynyt', 'khonsu' ); ?></h3>
      <p>Hakemallasi hakusanalla <i><?php echo get_search_query(); ?></i> <?php _e( 'ei löytynyt yhtikäs mitään.', 'khonsu' ); ?></p>
    </div><!-- .notification-box -->

      <div class="entry-content template-haku">

        <h2><?php _e( 'Hae uudestaan!', 'khonsu' ); ?></h2>

        <p><?php _e( 'Ei mittään hättää! Voit nimittäin etsiä uudella hakusanalla jokaisen '.wp_count_posts()->publish.' kirjoituksen joukosta. Ehkä uusintayritys tepsii.', 'khonsu' ); ?></p>

        <form method="get" id="searchform" action="<?php bloginfo( 'home' ); ?>/">
          <div><input type="text" value="<?php echo wp_specialchars( $s, 1 ); ?>" name="s" id="s" class="search" />
            <input type="submit" id="searchsubmit" value="Etsi merkintöjä" class="button" />
          </div>
        </form>

      </div><!-- .entry-content -->    

  <?php endif; ?>

  </div><!-- .container -->

</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
