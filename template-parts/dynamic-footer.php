<?php
/**
 * Dynamic footer
 *
 * @package khonsu
 */

if ( ! function_exists( 'is_front_page' ) ) :
  include( $_SERVER['DOCUMENT_ROOT'] . '/wp/wp-load.php' );
  include $_SERVER['DOCUMENT_ROOT'] . '/content/themes/khonsu/inc/simplecache.php';
  $cache = new SimpleCachePhp(__FILE__);
endif;
?>
<footer id="colophon" class="site-footer">

  <div class="footer-feeds">
    <div class="cols">

      <?php
        get_template_part( 'template-parts/instagram' );
        get_template_part( 'template-parts/lastfm' );
        get_template_part( 'template-parts/trakt' );
        get_template_part( 'template-parts/foursquare' );
        get_template_part( 'template-parts/albums' );
        get_template_part( 'template-parts/untappd' );
      ?>

    </div><!-- .cols -->
  </div><!-- .footer-feeds-->

  <div class="ending">
    <div class="cols-ending">
      <div class="col-ending col-ending-info">
        <p class="site-info"><a href="https://profiles.wordpress.org/rolle" class="thanks-wordpress" aria-label="WordPress-logo"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/wordpress.svg' ) ) ); ?></a><span class="info">Tämä on Rollemaa.org v22-<?php include( get_theme_file_path( 'inc/github.php' ) ); ?>, koodinimeltään "Khonsu", jonka moottorina toimii WordPress. Puhdasta käsityötä alusta loppuun. Koodatessa soi eniten <strong>Khonsu</strong>n <a href="https://www.last.fm/music/Khonsu/The+Xun+Protectorate">The Xun Protectorate</a>.</span></p>
      </div>

      <div class="col-ending col-ending-copyright">
        <p>Oikeudet omistaa <a href="https://plus.google.com/116255313263451216782?rel=author">Roni Laukkarinen</a>, 1999-<?php echo date( 'Y' ); ?>.<br />
          <a href="<?php echo get_page_link( 2768 ); ?>">Tietoa sivustosta</a></p>
      </div>
    </div>
  </div>

</footer><!-- #colophon -->
<?php
if ( ! function_exists( 'is_front_page' ) ) :
  $cache->CacheEnd();
endif;
