<?php
/**
 * Three most popular posts on current week.
 *
 * @package khonsu
 */

if ( function_exists( 'get_most_popular_posts' ) ) :
	$query = get_most_popular_posts( 'week', array(
		'posts_per_page' => 3,
	) );

	if ( $query->have_posts() ) : ?>

	<div class="block block-most-popular-this-week">
		<header class="block-header block-header-smaller">
			<h2 class="block-title"><span><?php echo esc_html_e( 'Tämän viikon luetuimmat', 'khonsu' ); ?></span></h2>
		</header>

		<div class="block-inner">
			<div class="columns">

				<?php
				while ( $query->have_posts() ) :
					$query->the_post();

					if ( has_post_thumbnail() ) :
						$featured_image = esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) );
					else :
						$featured_image = khonsu_get_random_image_url();
					endif;
					?>

					<div class="column">
						<div class="featured-image">
							<a href="<?php echo get_the_permalink(); ?>" style="background-image: url('<?php echo $featured_image; ?>');">
								<span class="screen-reader-text"><?php echo esc_html_e( 'Esikatselukuva artikkelille', 'khonsu' ); ?> "<?php echo get_the_title(); ?>"</span>
							</a>
						</div>

						<div class="column-titles">                  
							<h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
							<time datetime="<?php the_time( 'c' ); ?>"><?php echo ucfirst( get_the_time( 'l' ) ); ?>na, <?php the_time( 'j.' ); ?> <?php the_time( 'F' ); ?>ta <?php the_time( 'Y' ); ?></time>
						</div><!-- .column-titles -->
					</div><!-- .column -->

				<?php endwhile; ?>

			</div><!-- .columns -->
		</div><!-- .block-inner -->

	</div><!-- .block -->
	<?php 
endif; 
endif;
wp_reset_postdata();
