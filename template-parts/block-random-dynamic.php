<?php
/**
 * Random posts.
 *
 * Dynamic version that loads up via JS.
 *
 * @package khonsu
 */

include_once( $_SERVER['DOCUMENT_ROOT'] . '/wp/wp-load.php' ); 

$args = array(
	'post_type' => 'post',
	'posts_per_page' => 6,
	'orderby' => 'rand',
	'post_status' => 'publish',
	'no_found_rows' => true,

  // Ignore kuulumiset, elämä
	'tag__not_in'     => '79, 7',

  // Don't show too old posts
	'date_query' => array(
		'after' => '2007-01-01',
		'inclusive' => true,
	),
);

$loop = new WP_Query( $args );
if ( $loop->have_posts() ) : ?>

<?php while ( $loop->have_posts() ) :
$loop->the_post();

if ( has_post_thumbnail() ) :
	$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' )[0];
else :
	$post_thumbnail = khonsu_get_random_image_url();
endif;
?>

<div class="entry">
	<div class="entry-featured-image" style="background-image:url('<?php echo $post_thumbnail; ?>');"><a href="<?php echo get_the_permalink(); ?>" class="absolute-link"><span class="screen-reader-text">Link to article "<?php echo get_the_title(); ?>"</span></a></div>

	<div class="entry-details">
		<h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
		<?php if ( has_excerpt() ) : ?>
			<p><?php echo get_the_excerpt(); ?></p>
		<?php else : ?>
			<p>
				<?php
				$sentence = preg_match( '/^([^.!?]*[\.!?]+){0,3}/', strip_tags( get_the_content() ), $summary );
				echo strip_shortcodes( $summary[0] );
				?>
			</p>
		<?php endif; ?>

		<div class="entry-details-footer">
			<p><time datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'j.' ); ?> <?php the_time( 'F' ); ?>ta <?php the_time( 'Y' ); ?></time> <span class="dot-divider"></span> <?php echo khonsu_estimated_reading_time(); ?></p>
		</div><!-- .entry-footer -->

	</div><!-- .entry-details -->              
</div><!-- .entry -->
<?php endwhile;
endif; ?>
