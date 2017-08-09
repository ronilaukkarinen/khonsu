<?php
/**
 * Template Name: Haku
 *
 * @package khonsu
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<div class="container container-narrow">
			<?php while ( have_posts() ) {
				the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1>Haku</h1>
					</header><!-- .entry-header -->

					<div class="entry-content template-haku">

						<h2>Jotain hukassa?</h2>

						<p><?php _e( 'No ei mikään ihme, sillä täällä on '.wp_count_posts()->publish.' kirjoitusta.', 'khonsu' ); ?></p>

						<form method="get" id="searchform" action="<?php bloginfo( 'home' ); ?>/">
							<div><input type="text" value="<?php echo wp_specialchars( $s, 1 ); ?>" name="s" id="s" class="search" />
								<input type="submit" id="searchsubmit" value="Etsi merkintöjä" class="button" />
							</div>
						</form>

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
