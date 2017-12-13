<?php
/**
 * Template Name: Arkisto
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
						<h1 class="entry-title"><?php _e( 'Arkisto', 'khonsu' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content template-arkisto">

						<h2><?php _e( 'Historian lehtien havinaa', 'khonsu' ); ?></h2>
						<p><?php _e( 'Aika kuluu. Olin joskus nuorempi. Täällä ne kuitenkin ovat, kaikki merkinnät, jotka olen saanut pelastettua, vuodesta 2005 eteenpäin. Vanhempiakin oli jossain vaiheessa näkyvillä, mutta niitä on tuhoutunut ja suurimman osan vedin pois netistä niiden sisällöttömyyden ja naiiviuden vuoksi.', 'khonsu' ); ?></p>

						<?php include( TEMPLATEPATH . '/template-parts/ads-google-middle.php' ); ?>

						<h2 class="title-grouped"><?php _e( 'Avainsanapilvi', 'khonsu' ); ?></h2>
						<h4>Avainsanoja käytetty yhteensä 
							<?php
							$tags = get_tags();
							echo count( $tags );
							?>. Alla suosituimmat.</h4>		

							<div class="tag-cloud">
								<ul>
									<?php
									foreach ( $tags as $key => $tag ) :
										if ( 'twitter-tilapäivitys' !== $tag->name ) :
											if ( $tag->count > 20 ) :
												echo '<li><a href="' . get_home_url() . '/avainsana/' . $tag->slug . '" title="' . $tag->name . ' - käytetty ' . $tag->count . ' kertaa!" style="font-size:';

												if ( $tag->count > 100 ) :
													echo $tag->count / 1.2;
												else :
													echo $tag->count * 3;
												endif;

												echo '%';
												echo ' !important;"> '.$tag->name.'</a></li>';
											endif;
										endif;
									endforeach;
									?>
								</ul>
							</div>

							<h2 id="kohut"><?php _e( '30 kaikkien aikojen luetuinta kirjoitusta', 'khonsu' ); ?></h2>

							<?php
							if ( function_exists( 'get_most_popular_posts' ) ) :
								$query = get_most_popular_posts( 'alltime', array(
									'posts_per_page' => 30,
								) );

								if ( $query->have_posts() ) : ?>
								<ul>
									<?php while ( $query->have_posts() ) :
									$query->the_post();
									?><li><a href="<?php echo get_the_permalink(); ?>" rel="bookmark"><?php echo get_the_title(); ?> (<?php echo get_post_read_count( get_the_id(), 'alltime' ); ?>)</a></li>
								<?php endwhile; ?>
							</ul>
						<?php endif;
						wp_reset_postdata();
						endif; ?>

						<h2><?php _e( '30 kaikkien aikojen kommentoiduinta kirjoitusta', 'khonsu' ); ?></h2>

						<ul>
							<?php
							query_posts( 'orderby=comment_count&posts_per_page=30' );

							if ( have_posts() ) :
								while ( have_posts() ) :
									the_post();
									?>
									<li><a href="<?php the_permalink() ?>" title="Permanent Link to: <?php the_title_attribute(); ?>"><?php the_title(); ?></a> <?php echo '(' . get_comments_number() . ')'; ?></li>      

									<?php
								endwhile;
							endif;
							wp_reset_query();
							?>
						</ul>

						<h2><?php _e( 'Täydellinen blogiarkisto', 'khonsu' ); ?></h2>

						<p><?php _e( 'Janoat lisää? Oletko varma? Ellen jo jossain maininnut, Rollemaa sisältää yhteensä ' .wp_count_posts()->publish . ' kirjoitusta, joka pitää sisällään yhteensä ' . post_word_count_by_author() . ' sanaa. Voit selata listausta <a href="' . get_page_link( 8609 ) . '">omalta sivultaan</a>, mutta älä sano etten varoittanut!', 'khonsu' ); ?></p>

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
