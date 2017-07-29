<?php
/**
 * Untappd module
 *
 * This module retrieves data from Untappd.
 *
 * @package khonsu
 */

// Fetch Untappd data and set up simple cache
$untappd_url = 'https://api.untappd.com/v4/user/info/rolle/?client_id=' . getenv( 'UNTAPPD_CLIENT_ID' ) . '&client_secret=' . getenv( 'UNTAPPD_CLIENT_SECRET' );
$untappd_cachefile = get_theme_file_path( 'inc/cache/untappd.json' );
$untappd_cachetime = 7200; // Two hours

// If cache file does not exist, let's create it
if ( ! file_exists( $untappd_cachefile ) ) {
    copy( $untappd_url, $untappd_cachefile );
}

// Set up feed
$json = file_get_contents( $untappd_cachefile );
$feed = json_decode( $json, true );
?>

<div class="col equal">
  <div class="untappd service">
    <h2 class="feed-title untappd"><a href="https://untappd.com/user/rolle" target="_blank" title="Rolle Untappdissa"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/untappd.svg' ) ) ); ?> <span><?php echo esc_html_e( 'Viimeksi tuopissa', 'khonsu' ); ?></span></a></h2>
</div><!-- .service -->

<?php
// Check that feed item exists
if ( isset( $feed['response']['user']['checkins'] ) ) :

// Serve from the cache if it is younger than $untappd_cachetime
if ( file_exists( $untappd_cachefile ) && time() - $untappd_cachetime < filemtime( $untappd_cachefile ) ) :
    // Do nothing, it's cached
else :
    // If time ran out, copy over
    copy( $untappd_url, $untappd_cachefile );
endif;

foreach ( $feed['response']['user']['checkins']['items'] as $i ) : ?>

    <div class="feed-item equal beer" style="background-image: url('<?php if ( ! empty( $i['media']['items'] ) ) { foreach ( $i['media']['items'] as $media ) { echo $media['photo']['photo_img_md']; } } else { echo get_template_directory_uri() . '/images/default-beer.jpg'; } ?>');">

        <div class="info-overlay">
            <h3><a href="https://untappd.com/user/rolle"><?php echo $i['brewery']['brewery_name']; ?> <?php echo $i['beer']['beer_name']; ?></a></h3>
            <h4><?php echo $i['beer']['beer_style']; ?></h4>
        </div>

    </div><!-- .feed-item-->

<?php
endforeach;
else : ?>

    <div class="feed-item equal beer" style="background-image: url('<?php echo get_template_directory_uri() . '/images/default-beer.jpg'; ?>');">

        <div class="info-overlay">
            <h3><a href="https://untappd.com/user/rolle">Olutta ei saatu haettua</a></h3>
            <h4>Paukkuneet kaistarajat vastaan Untappdissa. Kokeile myöhemmin uudelleen.</h4>
        </div>

    </div><!-- .feed-item-->

<?php 
endif;
?>

</div><!-- .col -->
</div><!-- .cols -->
