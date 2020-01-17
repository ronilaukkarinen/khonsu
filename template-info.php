<?php
/**
 * Template Name: Info
 *
 * @package khonsu
 */

get_header(); ?>

<div id="content" class="content-area">
  <main role="main" id="main" class="site-main">
    <div class="container container-page container-info">

     <?php while ( have_posts() ) {
      the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

       <?php the_content(); ?>

       <?php if ( get_edit_post_link() ) { ?>
        <footer class="entry-footer">
         <?php edit_post_link(
          sprintf(
           /* translators: %s: Name of current post */
           esc_html__( 'Muokkaa %s', '_s' ),
           the_title( '<span class="screen-reader-text">"', '"</span>', false )
         ),
          '<span class="edit-link">',
          '</span>'
        ); ?>
      </footer><!-- .entry-footer -->
    <?php } ?>
  </article><!-- #post-## -->

<?php } ?>
</div><!-- .container -->

</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
