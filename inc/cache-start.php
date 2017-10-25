<?php
if ( getenv( 'WP_ENV' ) === 'development' || file_exists( dirname( __FILE__ ) . '/.dev' ) ) :
  $cachefile = '/var/www/rollemaa/content/themes/khonsu/inc/cache/index-cached.html';
else :
  $cachefile = '/var/www/rollemaa.fi/public_html/content/themes/khonsu/inc/cache/index-cached.html';
endif;

$hours = 12;
$cachetime = 3600 * $hours;
if ( file_exists( $cachefile ) && time() - $cachetime < filemtime( $cachefile ) ) {
	echo '<!-- Amazing hand crafted super cache by rolle, generated ' . date( 'H:i', filemtime( $cachefile ) ) . ' -->';
	include( sanitize_output( $cachefile ) );
	exit;
}
ob_start();
