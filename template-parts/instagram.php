<?php
/**
 * Instagram module
 *
 * @package khonsu
 */

$instagram_feed = dude_insta_feed()->get_user_images( '30821744' );
?>

<div class="col equal">
  <div class="instagram service">
    <h2 class="feed-title instagram"><a href="http://instagram.com/rolle_" target="_blank" title="Rollen Instagram-profiili"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/instagram.svg' ) ) ); ?> <span><?php echo esc_html_e( 'Viimeisimmät räpsyt', 'khonsu' ); ?></span></a></h2>

    <div class="feed-item images">
      <?php foreach ( $instagram_feed['data'] as $item ) :

      // Local images
      $remote_image_url = $item['images']['standard_resolution']['url'];
      $local_image_filename = clean( $item['link'] ) . '.png';
      $local_image = get_theme_file_path( '/inc/cache/instagram/' . $local_image_filename );
      $local_image_url = get_template_directory_uri() . '/inc/cache/instagram/' . $local_image_filename;
      if ( ! file_exists( $local_image ) ) :
        copy( $remote_image_url, $local_image );
      endif;
      ?>

        <div class="image">
          <a href="<?php echo $item['link']; ?>"><img src="<?php echo $local_image_url; ?>" alt="Instagram-kuva" /></a>

          <div class="ig-meta">
            <p><span class="likes"><svg width="15" height="15" fill="#fff" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26T145 952.5 77 855 23.5 734 0 596q0-220 127-344t351-124q62 0 126.5 21.5t120 58T820 276t76 68q36-36 76-68t95.5-68.5 120-58T1314 128q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z"/></svg> <?php echo $item['likes']['count']; ?></span><span class="comments"><svg width="15" height="15" fill="#fff" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1792 896q0 174-120 321.5t-326 233-450 85.5q-70 0-145-8-198 175-460 242-49 14-114 22-17 2-30.5-9t-17.5-29v-1q-3-4-.5-12t2-10 4.5-9.5l6-9 7-8.5 8-9q7-8 31-34.5t34.5-38 31-39.5 32.5-51 27-59 26-76q-157-89-247.5-220T0 896q0-130 71-248.5T262 443t286-136.5T896 256q244 0 450 85.5t326 233T1792 896z"/></svg> <?php echo $item['comments']['count']; ?></span></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div><!-- .service -->
</div><!-- .col -->
