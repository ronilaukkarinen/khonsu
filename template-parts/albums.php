<?php
/**
 * Last.fm albums module
 *
 * @package khonsu
 */

?>

<div class="col col-min">
  <div class="lastfm service">
    <h2 class="feed-title albums"><a href="http://www.last.fm/user/rolle-/albums" target="_blank" title="Rollen Last.fm-profiili"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/lastfm.svg' ) ) ); ?> <span><?php echo esc_html_e( 'Viikon levyt', 'khonsu' ); ?></span></a></h2>

    <div class="feed-item album-list">

      <?php
      // Fetch Last.fm album data and set up simple cache
      $albums_url = 'https://ws.audioscrobbler.com/2.0/?method=user.getTopAlbums&user=rolle-&api_key=' . getenv( 'LASTFM_API_KEY' ) . '&period=7day&limit=4';
      $albums_cachefile = get_theme_file_path( 'inc/cache/albums.xml' );
      $albums_cachetime = 36000; // Ten hours

      if ( strpos( file_get_contents( $albums_url ), '<?xml' ) !== false ) :

        // If cache file does not exist, let's create it
        if ( ! file_exists( $albums_cachefile ) ) {
          touch( $albums_cachefile );
          copy( $albums_url, $albums_cachefile );
        }

        // If file is older than cache time, overwrite file
        if ( time() - filemtime( $albums_cachefile ) > 2 * $albums_cachetime ) {
          copy( $albums_url, $albums_cachefile );
        }

        // Set up feed
        $lastfm_rss = simplexml_load_file( $albums_url );
        $lastfm_list = $lastfm_rss->xpath( '//album' );

      foreach ( $lastfm_list as $lastfm_item ) :

        $lastfm_image = $lastfm_item->image[3];
        $lastfm_image_filename = basename( $lastfm_image );

        if ( getenv( 'WP_ENV' ) === 'development' || file_exists( dirname( __FILE__ ) . '/.dev' ) ) {
          $local_coverart = '/var/www/rollemaa/album-image-db/' . $lastfm_image_filename;
        } else {
          $local_coverart = '/var/www/rollemaa.fi/public_html/album-image-db/' . $lastfm_image_filename;
        }

        copy( $lastfm_image, $local_coverart );

        if ( '' !== $lastfm_image ) :
          $local_coverart = get_home_url() . '/album-image-db/' . $lastfm_image_filename;
        else :
          $local_coverart = get_template_directory_uri() . '/images/default-album.png';
        endif;
        ?>

        <div class="album">
          <a class="albumlink" href="<?php echo $lastfm_item->url; ?>" title="<?php echo $lastfm_item->artist->name; ?> - <?php echo $lastfm_item->name; ?> kuunneltu <?php echo $lastfm_item->playcount; ?> kertaa viikon sisään">
            <img class="album" src="<?php echo $local_coverart; ?>" alt="Levy: <?php echo $lastfm_item->artist->name; ?> - <?php echo $lastfm_item->name; ?>" />
          </a>
        </div>

      <?php endforeach;
      endif; ?>

    </div>

  </div><!-- .service -->
</div><!-- .col -->
