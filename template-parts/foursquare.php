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
$json = json_decode( $source, true );

$lat = $json['response']['user']['checkins']['items']['0']['venue']['location']['lat'];
$lng = $json['response']['user']['checkins']['items']['0']['venue']['location']['lng'];
$name = $json['response']['user']['checkins']['items']['0']['venue']['name'];
$city = $json['response']['user']['checkins']['items']['0']['venue']['location']['city'];
$country = $json['response']['user']['checkins']['items']['0']['venue']['location']['country'];
$category = $json['response']['user']['checkins']['items']['0']['venue']['categories'][0]['shortName'];
$url = 'http://foursquare.com/v/'.$json['response']['user']['checkins']['items']['0']['venue']['id'];

$mapurl = 'https://maps.google.com/maps/api/staticmap?sensor=true&amp;center='.$lat.','.$lng.'&amp;maptype=roadmap&amp;size=600x400&amp;style=saturation:-50&amp;style=feature:landscape|visibility:simplified&amp;style=feature:road.highway|visibility:simplified&amp;sensor=false&amp;zoom=13&amp;markers=color:green|'.$lat.','.$lng.'|';

?>

<div class="col equal">

	<div class="foursquare service">
		<h2 class="feed-title foursquare"><a href="http://foursquare.com/rolle" target="_blank" title="Rollen Foursquare-profiili"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/foursquare.svg' ) ) ); ?> <span><?php echo esc_html_e( 'Viimeksi käyty', 'khonsu' ); ?></span></a></h2>
	</div><!-- .service -->

	<div class="feed-item place equal" style="background-image: url('<?php echo $mapurl; ?>');">

		<div class="shade"></div>
		<div class="info-overlay">
			<h3><a href="<?php echo $url; ?>" title="<?php echo $name; ?> Foursquaressa"><?php echo $name; ?></a></h3>
			<h4><?php echo $category; ?>, <?php echo $city; ?></h4>
		</div>

	</div>

</div>
