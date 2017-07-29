<?php
/**
 * Foursquare module
 *
 * @package khonsu
 */

require( get_theme_file_path( '/inc/foursquare/FoursquareAPI.class.php' ) );
$foursquare = new FoursquareAPI( getenv( 'FOURSQUARE_API_KEY' ) , getenv( 'FOURSQUARE_SECRET' ) );
$foursquare->SetAccessToken( getenv( 'FOURSQUARE_AUTH_TOKEN' ) );
$endpoint = 'users/self';
$source = $foursquare->GetPrivate( $endpoint );

// Set up simple cache
$foursquare_cachefile = get_theme_file_path( 'inc/cache/foursquare.json' );
$foursquare_cachetime = 43200; // 12 hours

// If cache file does not exist, let's create it
if ( ! file_exists( $foursquare_cachefile ) ) {
    file_put_contents( $foursquare_cachefile, $source );
}

$source = file_get_contents( $foursquare_cachefile );
$json = json_decode( $source, true );

$lat = $json['response']['user']['checkins']['items']['0']['venue']['location']['lat'];
$lng = $json['response']['user']['checkins']['items']['0']['venue']['location']['lng'];
$name = $json['response']['user']['checkins']['items']['0']['venue']['name'];
$city = $json['response']['user']['checkins']['items']['0']['venue']['location']['city'];
$country = $json['response']['user']['checkins']['items']['0']['venue']['location']['country'];
$category = $json['response']['user']['checkins']['items']['0']['venue']['categories'][0]['shortName'];
$url = 'http://foursquare.com/v/'.$json['response']['user']['checkins']['items']['0']['venue']['id'];

// Check if feed items exist
if ( isset( $json['response']['user']['checkins'] ) ) :

// Serve from the cache if it is younger than $foursquare_cachetime
if ( file_exists( $foursquare_cachefile ) && time() - $foursquare_cachetime < filemtime( $foursquare_cachefile ) ) :
    // Do nothing, it's cached
else :
    // If time ran out, copy over
    file_put_contents( $foursquare_cachefile, $json );
endif;

$lat = $json['response']['user']['checkins']['items']['0']['venue']['location']['lat'];
$lng = $json['response']['user']['checkins']['items']['0']['venue']['location']['lng'];
$name = $json['response']['user']['checkins']['items']['0']['venue']['name'];
$city = $json['response']['user']['checkins']['items']['0']['venue']['location']['city'];
$country = $json['response']['user']['checkins']['items']['0']['venue']['location']['country'];
$category = $json['response']['user']['checkins']['items']['0']['venue']['categories'][0]['shortName'];
$url = 'http://foursquare.com/v/' . $json['response']['user']['checkins']['items']['0']['venue']['id'];

$mapurl = 'https://maps.google.com/maps/api/staticmap?sensor=true&center=' . $lat . ',' . $lng . '&maptype=roadmap&size=600x400&style=saturation:-50&style=feature:landscape|visibility:simplified&style=feature:road.highway|visibility:simplified&sensor=false&zoom=13&markers=color:green|' . $lat . ',' . $lng . '|';

// Local map image
$local_mapfilename = clean( $lat ) . ',' . clean( $lng ) . '.png';
$local_mapimage = get_theme_file_path( '/inc/cache/foursquare/' . $local_mapfilename );
$local_mapurl = get_template_directory_uri() . '/inc/cache/foursquare/' . $local_mapfilename;
if ( ! file_exists( $local_mapimage ) ) :
  copy( $mapurl, $local_mapimage );
endif;
?>

<div class="col equal">

	<div class="foursquare service">
		<h2 class="feed-title foursquare"><a href="http://foursquare.com/rolle" target="_blank" title="Rollen Foursquare-profiili"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/foursquare.svg' ) ) ); ?> <span><?php echo esc_html_e( 'Viimeksi käyty', 'khonsu' ); ?></span></a></h2>
	</div><!-- .service -->

	<div class="feed-item place equal" style="background-image: url('<?php echo $local_mapurl; ?>');">

		<div class="shade"></div>
		<div class="info-overlay">
			<h3><a href="<?php echo $url; ?>" title="<?php echo $name; ?> Foursquaressa"><?php echo $name; ?></a></h3>
			<h4><?php echo $category; ?>, <?php echo $city; ?></h4>
		</div>

	</div>

</div>

<?php
endif;
