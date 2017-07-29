<?php
/**
 * Untappd module
 *
 * @package khonsu
 */

$url = $_SERVER["SCRIPT_NAME"];
$break = Explode('/', $url);
$path = realpath(dirname(__FILE__));
$file = $break[count($break) - 1];
$cachefile = $path.'/cached-'.substr_replace($file ,"",-4).'.html';
$cachetime = 7200; // 1800 = puoli tuntia, 7200 = 2h

date_default_timezone_set('Europe/Helsinki');
setlocale(LC_ALL, 'fi_FI.UTF-8');

// Serve from the cache if it is younger than $cachetime
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
    echo "<!-- Kakutettu html-kopio, generoitu klo ".date('H:i', filemtime($cachefile))." -->\n";
    include($cachefile);
} else {
ob_start(); // Start the output buffer
// ===============================================

require_once get_theme_file_path( 'inc/untappd/UntappdPHP.php' );

$config = array(
    'clientId'     => getenv('UNTAPPD_CLIENT_ID'),
    'clientSecret' => getenv('UNTAPPD_CLIENT_SECRET'),
    'redirectUri'  => 'https://www.rollemaa.fi/content/themes/khonsu/inc/untappd.php',
    'accessToken'  => getenv('UNTAPPD_ACCESS_TOKEN'),
);

$untappd = new Pintlabs_Service_Untappd( $config ); 
?>

<div class="col equal">
  <div class="untappd service">
    <h2 class="feed-title untappd"><a href="https://untappd.com/user/rolle" target="_blank" title="Rolle Untappdissa"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/untappd.svg' ) ) ); ?> <span><?php echo esc_html_e( 'Viimeksi tuopissa', 'khonsu' ); ?></span></a></h2>
</div><!-- .service -->

<?php
try {
    $feed = $untappd->userFeed( $username = 'rolle', '1', '' );
} catch (Exception $e) { 
    ?>

    <div class="feed-item equal beer" style="background-image: url('<?php echo get_template_directory_uri() . '/images/default-beer.jpg'; ?>');">

      <div class="info-overlay">
        <h3><a href="https://untappd.com/user/rolle">Olutta ei saatu haettua</a></h3>
        <h4>Paukkuneet kaistarajat vastaan Untappdissa. Virhe: <?php echo $e->getMessage(); ?>. Kokeile myöhemmin uudelleen.</h4>
    </div>

</div><!-- .feed-item-->

<?php 
}
foreach ($feed->response->checkins->items as $i) { ?>

<div class="feed-item equal beer" style="background-image: url('<?php if ( ! empty( $i->media->items ) ) { foreach ($i->media->items as $media) { echo $media->photo->photo_img_md; } } else { echo get_template_directory_uri() . '/images/default-beer.jpg'; } ?>');">

  <div class="info-overlay">
    <h3><a href="https://untappd.com/user/rolle"><?php echo $i->brewery->brewery_name; ?> <?php echo $i->beer->beer_name; ?></a></h3>
    <h4><?php echo $i->beer->beer_style; ?></h4>
</div>

</div><!-- .feed-item-->

<?php
} ?>
</div><!-- .col -->
</div><!-- .cols -->

<?php
// ===============================================
// Cache the contents to a file
$cached = fopen($cachefile, 'w');
fwrite($cached, ob_get_contents());
fclose($cached);
ob_end_flush(); // Send the output to the browser
}
