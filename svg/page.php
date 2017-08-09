<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package khonsu
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

    <div class="container container-article">
      <?php while ( have_posts() ) {
      	the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				  <header class="entry-header">
				    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				  </header><!-- .entry-header -->

				  <div class="entry-content">
				    <?php the_content();

				      wp_link_pages( array(
				        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'khonsu' ),
				        'after'  => '</div>',
				      ) );
				    ?>
				  </div><!-- .entry-content -->

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
