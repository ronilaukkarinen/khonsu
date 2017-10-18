<?php
/**
 * YARPP Template: Lue lisää
 * Description: Lue lisää -osio.
 * Author: Roni Laukkarinen
 *
 * @package khonsu
 */

if ( $related_query->have_posts() ) : ?>
<ol class="related-posts">
  <?php while ( $related_query->have_posts() ) :
  $related_query->the_post();

  if ( has_post_thumbnail() ) :
    $img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[0];
    endif; ?>

    <li class="entry">
      <div class="entry-featured-image" style="background-image:url('<?php if ( has_post_thumbnail() ) : echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' )[0]; else : echo khonsu_get_random_image_url(); endif; ?>');"><a href="<?php echo get_the_permalink(); ?>" class="absolute-link"><span class="screen-reader-text"><?php _e( 'Linkki artikkeliin', 'khonsu' ); ?> "<?php echo get_the_title(); ?>"</span></a></div>

      <div class="entry-details">
        <h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>

        <div class="entry-details-footer">
          <p><time datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'j.' ); ?> <?php the_time( 'F' ); ?>ta <?php the_time( 'Y' ); ?></time> <span class="dot-divider"><span class="screen-reader-text">Divider</span></span> <?php echo khonsu_estimated_reading_time(); ?></p>
        </div><!-- .entry-footer -->

      </div><!-- .entry-details -->              
    </li><!-- .entry -->

  <?php endwhile; ?>
</ol>
<?php endif; ?>
