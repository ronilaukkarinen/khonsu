<?php
/**
 * Template Name: Pelkkä elokuvasivu
 *
 * @package khonsu
 */

include get_theme_file_path( 'inc/leffat/header.php' );
?>

<?php
if ( getenv( 'WP_ENV' ) === ' development ' || file_exists( dirname( __FILE__ ) . '/.dev' ) ) :
	require( '/var/www/rollemaa/leffa/ratings-drawrating.php' );
else :
	require( $_SERVER['DOCUMENT_ROOT'] . '/leffa/ratings-drawrating.php' );
endif;

wp_movie_ratings_show( 20, array( 'page_mode' => 'yes' ) );

include get_theme_file_path( 'inc/leffat/footer.php' );
