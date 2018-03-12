<?php
/**
 * Ads for the middle section of the page
 *
 * @package khonsu
 */

if ( is_home() && ! is_paged() ) :

$args = array(
	'post_type' => 'ads',
	'posts_per_page' => 1,
	'no_found_rows' => true,
	'post_status' => 'publish',
);

$ad = new WP_Query( $args );
if ( $ad->have_posts() ) :
while ( $ad->have_posts() ) :
$ad->the_post();

if ( 'etusivu' === get_field( 'slotti' ) ) :
if ( strtotime( get_field( 'eraantymispaiva' ) ) > time() ) : ?>

	<div class="advertisement ad advert textad" id="placement">
		<span class="close ad textad" data-wenk="Älä näytä enää näitä, kiitos" data-wenk-pos="top"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/close.svg' ) ) ); ?></span>
		
		<div class="ad-top ad textad">
			<?php echo get_field( 'mainoskoodi' ); ?>
		</div><!-- .textad -->
	</div><!-- .ad -->

<?php
endif;
endif;
endwhile;
endif;
endif;
