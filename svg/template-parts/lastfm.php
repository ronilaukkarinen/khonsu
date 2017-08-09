<?php
/**
 * Last.fm module
 *
 * @package khonsu
 */

$cache = 'lastfm.recent.cache';
$seconds_before_update = 1800;
$number_of_songs = 1;
$socket_timeout = 3; // Seconds to wait for response from audioscrobbler
?>

<div class="col equal col-lastfm">
  <div class="lastfm lastfm-last service">
    <h2 class="feed-title lastfm"><a href="http://www.last.fm/user/rolle-" target="_blank" title="Rollen Last.fm-profiili"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/lastfm.svg' ) ) ); ?> <span><?php echo esc_html_e( 'Viimeksi kuunneltu', 'khonsu' ); ?></span></a></h2>

    <div class="feed-item now-playing">
      <?php
      if ( ! file_exists( $cache ) ) :
        touch( $cache );
      endif;

      $last_modified = filemtime( $cache );
      if ( time() - $last_modified > $seconds_before_update ) :
        @ini_set( 'default_socket_timeout', $socket_timeout );

        $getrecentlyplayed = simplexml_load_file( 'https://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=rolle-&api_key=' . getenv( 'LASTFM_API_KEY' ) );
        $row = '';
        foreach ( $getrecentlyplayed->recenttracks->track as $recenttrack ) {
          $row .= '1234567890,' . $recenttrack->artist . ' - ' . $recenttrack->name . '\n';
        }

        $recently_played_songs = $row;
        if ( strlen( $recently_played_songs ) === 1 ) :
          touch( $cache );
        else :
          $handle = fopen( $cache, 'w' );
          fwrite( $handle, $recently_played_songs );
          fclose( $handle );
        endif;
      endif;

      $cache_size = filesize( $cache );
      if ( $cache_size < 5 ) : ?>

      <a href="#" class="image-full-height artist-image" title="Virhe" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/default-band.jpg');"><img class="fit-image screen-reader-text artist-portrait" src="<?php echo get_template_directory_uri(); ?>/images/default-band.jpg" alt="Virhe" /></a>
      <div class="info-overlay">
        <h3><a href="https://www.last.fm/user/rolle-/"><?php echo esc_html_e( 'Last.fm API-virhe', 'khonsu' ); ?></a></h3>
        <h4><?php echo esc_html_e( 'Yritä myöhemmin uudelleen.', 'khonsu' ); ?></h4>
      </div>

    <?php else :
    $recently_played_songs = file_get_contents( $cache );
    $track = explode( '\n', $recently_played_songs );

    for ( $i = 0; $i < $number_of_songs; $i++ ) :

      $track_array = explode( ',', $track[ $i ] );
      $entry = explode( ' - ', $track_array[1] );

      $artistxml = simplexml_load_file( 'https://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist='.urlencode( $entry[0] ) . '&api_key=' . getenv( 'LASTFM_API_KEY' ) . '&limit=1' );

      foreach ( $artistxml->artist->image as $img ) :

        if ( 'mega' == $img['size'] ) :

          if ( '' === $img ) : ?>
          <a href="<?php echo get_template_directory_uri(); ?>/images/default-band.jpg" class="image-full-height fancy artist-image" title="' . htmlspecialchars( $entry[0] ) . ' - ' . htmlspecialchars( $entry[1] ) . '" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/default-band.jpg');"><img class="screen-reader-text artist-portrait" src="<?php echo get_template_directory_uri(); ?>/default-band.jpg" alt="Kuva artistista <?php echo htmlspecialchars( $entry[0] ); ?>" /></a>

        <?php else :


        $artist_image_filename = basename( $img );

        if ( getenv( 'WP_ENV' ) == 'development' || file_exists( dirname( __FILE__ ) . '/.dev' ) ) :
          $paikallinen_artistikuva = '/var/www/rollemaa/artist-image-db/' . $artist_image_filename;
        else :
          $paikallinen_artistikuva = '/var/www/rollemaa.fi/public_html/artist-image-db/' . $artist_image_filename;
        endif;

        copy( $img, $paikallinen_artistikuva );
        ?>

        <a href="<?php echo get_home_url(); ?>/artist-image-db/<?php echo $artist_image_filename; ?>" class="image-full-height fancy artist-image" title="<?php echo htmlspecialchars( $entry[0] ); ?> - <?php echo htmlspecialchars( $entry[1] ); ?>" style="background-image: url('<?php echo get_home_url(); ?>/artist-image-db/<?php echo $artist_image_filename; ?>');"><img class="fit-image screen-reader-text artist-portrait" src="<?php echo get_home_url(); ?>/artist-image-db/<?php echo $artist_image_filename; ?>" alt="Kuva artistista <?php echo htmlspecialchars( $entry[0] ); ?>" /></a>

        <?php
        endif;
      endif;
    endforeach;
    ?>

    <div class="info-overlay">
      <h3><a href="https://www.last.fm/music/<?php echo htmlspecialchars( $entry[0] ); ?>" class="fancy"><?php echo htmlspecialchars( $entry[0] ); ?></a></h3>
      <h4><?php echo htmlspecialchars( $entry[1] ); ?></h4>
    </div>

    <?php
  endfor;
  endif; ?>

</div><!-- .now-playing -->

</div><!-- .service -->
</div><!-- .col -->
