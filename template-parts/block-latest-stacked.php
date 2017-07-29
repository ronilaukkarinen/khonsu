<?php
/**
 * Latest in stack.
 *
 * @package khonsu
 */

// Greetings

$hour = date( 'H', time() );
if ( $hour > 6 && $hour <= 11 ) :
  $message = 'Toivottavasti aamusi alkoi mukavasti! alla uusimmat jutut';
elseif ( $hour > 11 && $hour <= 16 ) :
  $message = 'Tässä uusimmat jutut iltapäiväsi ratoksi';
elseif ( $hour > 16 && $hour <= 23 ) :
  $message = 'Uusimmat tekstini iltaasi sisältöä lisäämään';
else :
  $message = 'Eikö uni tule? alla uusimpia tekstejäni';
endif;

$args = array(
	'post_type' => 'post',
	'posts_per_page' => 3,
	'no_found_rows' => true,
	'post_status' => 'publish',
);

$loop = new WP_Query( $args );
if ( $loop->have_posts() ) : ?>

<div class="block block-latest-stacked">

	<header class="block-header block-header-smaller block-header-cols">
		<div class="block-header-col-content">
			<h2 class="block-title"><span><?php echo $message; ?></span></h2>
		</div>

		<div class="block-header-col-sidebar">
			<h2 class="block-title"><span><?php echo esc_html_e( 'Kymmenen suosituinta', 'khonsu' ); ?></span></h2>
		</div>		
	</header>

	<div class="content">
		<?php while ( $loop->have_posts() ) :
		$loop->the_post();
		?>

		<div class="entry-stack">
			<!-- <div class="entry-featured-image" style="background-image:url('<?php if ( has_post_thumbnail() ) : echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' )[0]; else : echo khonsu_get_random_image_url(); endif; ?>');"><a href="<?php echo get_the_permalink(); ?>" class="absolute-link"><span class="screen-reader-text">Link to article "<?php echo get_the_title(); ?>"</span></a></div> -->

			<div class="entry-stack-header">
				<p><time datetime="<?php the_time( 'c' ); ?>"><?php the_time( ' j. ' ); ?> <?php the_time( ' F ' ); ?>ta</time> <span class="dot-divider"></span> <?php echo khonsu_estimated_reading_time(); ?></p>
			</div><!-- .entry-footer -->

			<div class="entry-stack-details">
				<h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
				<?php if ( has_excerpt() ) : ?>
					<p><?php echo get_the_excerpt(); ?></p>
				<?php else : ?>
					<p>
						<?php
						$sentence = preg_match( '/^([^.!?]*[\.!?]+){0,2}/', strip_tags( get_the_content() ), $summary );
						echo strip_shortcodes( $summary[0] );
						?>
					</p>
				<?php endif; ?>

				<div class="entry-stack-details-read-more">

					<?php if ( 0 === get_comments_number() || empty( get_comments_number() ) ) : ?>
						<p><?php _e( 'Teksti jatkuu vielä.', 'khonsu' ); ?> <a href="<?php the_permalink(); ?>"><?php _e( 'Lue loppuun.', 'khonsu' ); ?></a></p>
					<?php else :

					$args_comments = array(
						'number' => '1',
						'post_id' => $post->ID,
					);

					$comments = get_comments( $args_comments );

					foreach ( $comments as $comment ) : ?>

					<?php if ( ! empty( $comment->comment_author_email ) ) : ?>
						<div class="mini-avatar"><?php echo( get_avatar( $comment->comment_author_email, 42 ) ); ?></div>

						<p><?php echo $comment->comment_author; ?> <?php _e( 'kommentoi viimeksi', 'khonsu' ); echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' sitten'; if (get_comments_number() > 1 ) : ?> <?php echo get_comments_number() - 1; _e( 'muun lisäksi', 'khonsu' ); endif; ?>. <a href="<?php the_permalink(); ?>"><?php _e( 'Katso mistä puhutaan.', 'khonsu' ); ?></a></p>

					<?php else : ?>

						<p><?php _e( 'Tekstiä on linkitetty, mutta ei vielä kommentoitu.', 'khonsu' ); ?> <a href="<?php the_permalink(); ?>"><?php _e( 'Lue loppuun.', 'khonsu' ); ?></a></p>

					<?php endif; ?>

				<?php endforeach;
				?>
			<?php endif; ?>
		</div>

	</div><!-- .entry-stack -->              
</div><!-- .entry -->
<?php endwhile; ?>
</div><!-- .content -->

<div class="sidebar">

	<?php
	if ( function_exists( 'get_most_popular_posts' ) ) :
		$query = get_most_popular_posts( 'alltime', array(), array(
			'posts_per_page' => 10,
		) );

		if ( $query->have_posts() ) : ?>

		<div class="hottest">
			<ol>
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<li><h3><a class="hot-link" href="<?php echo get_the_permalink(); ?>" rel="bookmark"><?php echo get_the_title(); ?></a></h3></li>
				<?php endwhile; ?>
			</ol>
		</div>

	<?php endif; ?>
<?php endif; ?>     

</div>

</div><!-- .block -->
<?php endif; ?>
