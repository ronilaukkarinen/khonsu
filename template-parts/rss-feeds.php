<?php
/**
 * Merge multiple RSS feeds to one and display them on a web page
 *
 * @package khonsu
 */

?>

<div class="block block-network">

	<header class="block-header block-header-smaller">
		<h2 class="block-title"><span><?php echo esc_html_e( 'Uutta Rollen muissa verkkoteknologioissa', 'khonsu' ); ?></span></h2>
	</header>

	<div class="content">

		<?php require_once( get_template_directory() . '/inc/simplepie/autoloader.php' );
		$feed = new SimplePie();
		$feed->set_cache_location( get_template_directory() . '/inc/simplepie/library/cache' );
		$feed->set_cache_duration( 600 );
		$feed->set_feed_url( array(
			'https://twitrss.me/twitter_user_to_rss/?user=rolle',
			'https://geekylifestyle.com/feed/',
			'https://www.dude.fi/feed/',
			'https://www.huurteinen.fi/feed/',
			'https://www.rollemaa.org/leffat-rss.php',
			'https://medium.com/feed/@rolle/',
		));

		$feed->handle_content_type();
		$feed->set_item_limit( 1 );
		$feed->init();

		foreach ( $feed->get_items() as $item ) :
			$feed = $item->get_feed();

			// Custom stuff, avatars and extra titles
			if ( $feed->get_link() === 'https://twitter.com/rolle' ) :
				$avatar = get_template_directory_uri() . '/images/avatar-twitter.jpg';
				$title = '@rolle Twitterissä';
				$title_extra = '';
				$title_item = $item->get_title();

			else :
				$title = $feed->get_title();
				$title_item = $item->get_title();
			endif;

			if ( $feed->get_link() === 'http://www.rollemaa.org/leffat' ) :
				$avatar = get_template_directory_uri() . '/images/avatar-leffat.png';
				$title_extra = 'Elokuva-arvio: ';
			endif;

			if ( $feed->get_link() === 'https://www.huurteinen.fi/' ) :
				$avatar = get_template_directory_uri() . '/images/avatar-huurteinen.png';
				$title_extra = 'Olutarvio: ';
			endif;

			if ( $feed->get_link() === 'https://geekylifestyle.com/' ) :
				$avatar = get_template_directory_uri() . '/images/avatar-geekylifestyle.jpg';
				$title_extra = '';
			endif;

			if ( $feed->get_link() === 'https://www.dude.fi/' ) :
				$avatar = get_template_directory_uri() . '/images/avatar-dude.png';
				$title_extra = '';
			endif;

			if ( stripos( strtolower( $feed->get_link() ), 'medium.com' ) !== false ) :
				$avatar = get_template_directory_uri() . '/images/avatar-medium.png';
				$title_extra = '';
			endif;
			?>

			<div class="column">
				<h4><a href="<?php echo $item->get_link(); ?>">
					<?php
					echo $title_extra;
					echo $title_item;
					?></a></h4>

				<div class="meta">		
					<div class="meta-avatar" style="background-image: url('<?php echo $avatar; ?>');"></div>
					<div class="meta-title-stuff">
						<h5><a href="<?php echo $feed->get_link(); ?>"><?php echo $title; ?></a></h5>
						<h6><time><?php echo human_time_diff( $item->get_date( 'U' ), current_time( 'timestamp' ) ) . ' sitten'; ?></time></h6>
					</div>
				</div>
			</div>

		<?php endforeach; ?>

	</div><!-- .content -->

</div><!-- .block -->

