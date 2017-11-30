<?php
/**
 * Template Name: Info
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
						<h1 class="entry-title"><?php _e( 'Tietoa minusta ja sivustosta', 'khonsu' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content template-info">

						<h2><?php _e( 'Kuka Rolle?', 'khonsu' ); ?></h2>

						<?php if ( has_post_thumbnail() ) : ?>
							<div class="author-image">
								<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" alt="Rolle" />

								<div class="author-image-caption">
									<p><?php the_post_thumbnail_caption(); ?></p>
								</div>
							</div>
							<?php endif;

							the_content(); ?>

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
