<?php
/**
 * Trakt module
 *
 * @package khonsu
 */

$url = 'https://trakt.tv/users/rolle/history.atom?slurm=' . getenv( 'TRAKT_API_KEY' ); ?>

<div class="col equal col-trakt trakt-default">
	<div class="trakt service">
		<h2 class="feed-title trakt"><a href="http://www.trakt.tv/user/rolle" target="_blank" title="Rollen Trakt.tv-profiili"><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/trakt.svg' ) ) ); ?> <span><?php echo esc_html_e( 'Viimeksi katsottu', 'khonsu' ); ?></span></a></h2>

		<div class="feed-item">
			<?php
			if ( strpos( file_get_contents( $url ), '<?xml' ) !== false ) :
				$rss = simplexml_load_file( $url );
				$list = $rss->xpath( '//@url' );
				$prepared_urls = array();

				foreach ( $list as $item ) {
					$item = parse_url( $item );
					$prepared_urls[] = $item['scheme'] . '://' . $item['host'] . '' . $item['path'] . '';
				}

				$image = $prepared_urls[1];
				$trakt_image_filename = basename( $image );

				if ( getenv( 'WP_ENV' ) === 'development' || file_exists( dirname( __FILE__ ) . '/.dev' ) ) {
					$paikallinen_traktkuva = '/var/www/rollemaa/trakt-image-db/' . $trakt_image_filename;
				} else {
					$paikallinen_traktkuva = '/var/www/rollemaa.org/public_html/trakt-image-db/' .$trakt_image_filename;
				}

				copy( $image, $paikallinen_traktkuva );
				?>

				<div class="traktposter">
					<a href="http://trakt.tv/users/rolle"><img class="fit-image" src="<?php echo get_home_url(); ?>/trakt-image-db/<?php echo $trakt_image_filename; ?>" alt="Trakt" /></a>
				</div>

				<div class="info-overlay">
					<h3><a href="<?php echo $rss->entry->link->attributes()->href; ?>"><?php echo $rss->entry->title; ?></a></h3>
				</div>

			<?php endif; ?>
		</div><!-- .feed-item -->

	</div><!-- .service -->
</div><!-- .col-->
