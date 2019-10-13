<?php
/**
 * Gravity Forms specific, mostly for the legacy movie page.
 *
 * @package khonsu
 */

// Add placeholders (hidden label state)
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

// Add custom loading spinner
add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2 );
function spinner_url( $image_src, $form ) {
	return get_template_directory_uri() . '/images/movie-loader.gif';
}

// Add data based on fields submitted
// http://www.gravityhelp.com/forums/topic/entry-ids
add_action( 'gform_after_submission_1', 'add_submission_id', 10, 2 );
function add_submission_id( $entry, $form ) {

	if ( getenv( 'WP_ENV' ) === 'development' || file_exists( dirname( __FILE__ ) . '/.dev' ) ) {
		$baseurl = 'http://rollemaa.dev';
	} else {
		$baseurl = 'https://www.rollemaa.fi';
	}

	global $wpdb;

	$filmtitle_field = 5;
	$filmurl_field = 6;
	$imdbid = $entry['1'];

	if( getenv('WP_ENV') == "development" || file_exists( dirname( __FILE__ ) . '/.dev' ) ) {
		$paikallinen_tiedosto = '/var/www/rollemaa/leffa/poster-image-db/' . $imdbid . '.jpg';
		$paikallinen_backdrop = '/var/www/rollemaa/leffa/poster-image-db/' . $imdbid . '-backdrop.jpg';
	} else {
		$paikallinen_tiedosto = '/var/www/rollemaa.fi/public_html/leffa/poster-image-db/' . $imdbid . '.jpg';
		$paikallinen_backdrop = '/var/www/rollemaa.fi/public_html/leffa/poster-image-db/' . $imdbid . '-backdrop.jpg';
	}

	if ( ! file_exists( $paikallinen_tiedosto ) || ! file_exists( $paikallinen_backdrop ) ) {

		$ca = curl_init();
		curl_setopt( $ca, CURLOPT_URL, 'http://api.themoviedb.org/3/configuration?api_key=' . getenv('TMDB_API_KEY') );
		curl_setopt( $ca, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ca, CURLOPT_HEADER, false );
		curl_setopt( $ca, CURLOPT_HTTPHEADER, array( 'Accept: application/json' ) );
		$response = curl_exec( $ca );
		curl_close( $ca );
		$config = json_decode( $response, true );

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, 'http://api.themoviedb.org/3/find/tt'. $imdbid . '?api_key=' . getenv('TMDB_API_KEY') . '&external_source=imdb_id' );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Accept: application/json' ) );
		$response = curl_exec( $ch );
		curl_close( $ch );
		$result = json_decode( $response, true );

		$kuvan_osoite = '' . $config['images']['base_url'] . $config['images']['poster_sizes'][3] . $result['movie_results'][0]['poster_path'] . '';
		$backdrop_osoite = '' . $config['images']['base_url'] . $config['images']['backdrop_sizes'][2] . $result['movie_results'][0]['backdrop_path'] . '';
		copy( $kuvan_osoite, $paikallinen_tiedosto );
		copy( $backdrop_osoite, $paikallinen_backdrop );
	}
	if( getenv('WP_ENV') == "development" || file_exists( dirname( __FILE__ ) . '/.dev' ) ) {
		$paikallinen_metadata = '/var/www/rollemaa/leffa/metadata/' . $imdbid . '.json';
	} else {
		$paikallinen_metadata = '/var/www/rollemaa.fi/public_html/leffa/metadata/' . $imdbid . '.json';
	}

	if ( ! file_exists( $paikallinen_metadata ) ) {
		$movieurl = 'https://www.omdbapi.com/?i=tt' . $imdbid . '&apikey=' . getenv( 'OMDB_API' );
		copy( $movieurl, $paikallinen_metadata );
	}

 $json = file_get_contents( $baseurl.'/leffa/metadata/' . $imdbid . '.json' );
 $info = json_decode( $json, true );

 $filmtitle = $info['Title'];

 $wpdb->insert(
  "{$wpdb->prefix}rg_lead_detail", array(
    'value'         => $filmtitle,
    'field_number'  => $filmtitle_field,
    'lead_id'       => $entry['id'],
    'form_id'       => $entry['form_id'],
  )
);

 $imdburl = 'http://www.imdb.com/title/tt'.$imdbid;

 $wpdb->insert(
  "{$wpdb->prefix}rg_lead_detail", array(
    'value'         => $imdburl,
    'field_number'  => $filmurl_field,
    'lead_id'       => $entry['id'],
    'form_id'       => $entry['form_id'],
  )
);

}

// Add custom email notification with IMDb-fetch
add_filter( 'gform_notification_1', 'form_notification_email_1', 10, 3 );

function form_notification_email_1( $notification, $form, $entry ) {

	if ( getenv( 'WP_ENV' ) == 'development' || file_exists( dirname( __FILE__ ) . '/.dev' ) ) {
		$baseurl = 'http://rollemaa.dev';
	} else {
		$baseurl = 'https://www.rollemaa.fi';
	}

	// Fields:
	$imdbid = rgar( $entry, '1' );
	$suosittelija = rgar( $entry, '4' );

	if( getenv('WP_ENV') == "development" || file_exists( dirname( __FILE__ ) . '/.dev' ) ) {
		$paikallinen_tiedosto = '/var/www/rollemaa/leffa/poster-image-db/' . $imdbid . '.jpg';
		$paikallinen_backdrop = '/var/www/rollemaa/leffa/poster-image-db/' . $imdbid . '-backdrop.jpg';
	} else {
		$paikallinen_tiedosto = '/mnt/www/rollemaa.fi/public_html/leffa/poster-image-db/' . $imdbid . '.jpg';
		$paikallinen_backdrop = '/mnt/www/rollemaa.fi/public_html/leffa/poster-image-db/' . $imdbid . '-backdrop.jpg';
	}

	if ( ! file_exists( $paikallinen_tiedosto ) || ! file_exists( $paikallinen_backdrop ) ) {

		$ca = curl_init();
		curl_setopt( $ca, CURLOPT_URL, 'http://api.themoviedb.org/3/configuration?api_key=' . getenv('TMDB_API_KEY') );
		curl_setopt( $ca, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ca, CURLOPT_HEADER, false );
		curl_setopt( $ca, CURLOPT_HTTPHEADER, array( 'Accept: application/json' ) );
		$response = curl_exec( $ca );
		curl_close( $ca );
		$config = json_decode( $response, true );

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, 'http://api.themoviedb.org/3/find/tt' . $imdbid . '?api_key=' . getenv('TMDB_API_KEY') . '&external_source=imdb_id' );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Accept: application/json' ) );
		$response = curl_exec( $ch );
		curl_close( $ch );
		$result = json_decode( $response, true );

		$kuvan_osoite = '' . $config['images']['base_url'] . $config['images']['poster_sizes'][3] . $result['movie_results'][0]['poster_path'] . '';
		$backdrop_osoite = '' . $config['images']['base_url'] . $config['images']['backdrop_sizes'][2] . $result['movie_results'][0]['backdrop_path'] . '';
		copy( $kuvan_osoite, $paikallinen_tiedosto );
		copy( $backdrop_osoite, $paikallinen_backdrop );
	}
	if( getenv('WP_ENV') == "development" || file_exists( dirname( __FILE__ ) . '/.dev' ) ) {
		$paikallinen_metadata = '/var/www/rollemaa/leffa/metadata/' . $imdbid . '.json';
	} else {
		$paikallinen_metadata = '/var/www/rollemaa.fi/public_html/leffa/metadata/' . $imdbid . '.json';
	}

	if ( ! file_exists( $paikallinen_metadata ) ) {
		$movieurl = 'http://www.omdbapi.com/?i=tt' . $imdbid;
		copy( $movieurl, $paikallinen_metadata );
	}

  $json = file_get_contents( $baseurl.'/leffa/metadata/' . $imdbid . '.json' );
  $info = json_decode( $json, true );

  $runtimeseconds = $runtime * 60;
  $runtime_finnish_hours = gmdate( 'G', $runtimeseconds );
  $runtime_finnish_minutes = gmdate( 'i', $runtimeseconds );

  if ( $runtime_finnish_hours == 1 ) :
    $runtime_finnish_hour_label = 'tunti';
  else :
   $runtime_finnish_hour_label = 'tuntia';
 endif;

 if ( $runtime_finnish_minutes == 1 ) :
   $runtime_finnish_minutes_label = 'minuutti';
 else :
   $runtime_finnish_minutes_label = 'minuuttia';
 endif;

 $notification['message'] = '

 <strong>'.$suosittelija.' suosittelee:</strong>

 <h1 style="margin:0;padding:0">'.$info['Title'].'</h1>

 <a href="http://www.imdb.com/title/tt'. $imdbid .'/">
 <img src="'. $baseurl. '/leffa/poster-image-db/' . $imdbid . '-backdrop.jpg" alt="Elokuvan '.$info['Title'].' taustakuva" style="width: 700px; height: auto;"/><br /><br />
 <img src="'. $baseurl. '/leffa/poster-image-db/'. $imdbid .'.jpg" alt="Elokuvan '.$info['Title'].' juliste" />
 </a>

 <ul>
 <li><strong>Linkki:</strong>: <a href="http://www.imdb.com/title/tt'. $imdbid .'/">http://www.imdb.com/title/tt'. $imdbid .'</a></li>
 <li><strong>IMdb-pisteet:</strong> '.$info['imdbRating'].'</li>
 <li><strong>Ohjaus:</strong> '.$info['Director'].'</li>
 <li><strong>Pääosissa:</strong> '.$info['Actors'].'</li>
 <li><strong>Kesto:</strong> '.$runtime_finnish_hours.' '.$runtime_finnish_hour_label.', '.ltrim( $runtime_finnish_minutes, 0 ).' '.$runtime_finnish_minutes_label.'</li>
 <li><strong>Ilmestynyt:</strong> '.strftime( '%e. %B', strtotime( $info['Released'] ) ).' '.strftime( '%Y', strtotime( $info['Released'] ) ).'</li>
 <li><strong>Genre:</strong> '.$info['Genre'].'</li>
 <li><strong>Juoni:</strong> '.$info['Plot'].'</li>
 <li><strong>Palkinnot:</strong> '.$info['Awards'].'</li>
 <li><strong>Valmistusmaa:</strong> '.$info['Country'].'</li>
 </ul>

 '.$notification['message'];
 return $notification;
}

add_filter( 'gform_notification_1', 'form_notification_email_1', 10, 3 );
