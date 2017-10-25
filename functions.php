<?php
/**
 * The current version of the theme.
 *
 * @package khonsu
 */

define( 'AIR_VERSION', '2.7.8' );

/**
 * Requires.
 */
require get_theme_file_path( '/inc/functions.php' );
require get_theme_file_path( '/inc/menus.php' );
require get_theme_file_path( '/inc/nav-walker.php' );
require get_theme_file_path( '/inc/ads-post-type.php' );
require get_theme_file_path( '/inc/gravityforms.php' );

/**
 * Enable theme support for essential features.
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title'  => 'Khonsu',
			'menu_title'  => 'Khonsu',
			'menu_slug'   => 'khonsu-settings',
			'capability'  => 'edit_posts',
			'redirect'    => false,
			'icon_url'    => 'data:image/svg+xml;base64,' . base64_encode( '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="20" viewBox="0 0 24 24" fill="#9ea4aa"><path d="M12.89,3L14.85,3.4L11.11,21L9.15,20.6L12.89,3M19.59,12L16,8.41V5.58L22.42,12L16,18.41V15.58L19.59,12M1.58,12L8,5.58V8.41L4.41,12L8,15.58V18.41L1.58,12Z"/></svg>' ),
			'position' => 5,
		)
	);
}

/**
 * Clean local cached image filenames
 *
 * @param String $string String.
 */
function clean( $string ) {
	$string = str_replace( ' ', '-', $string ); // Replaces all spaces with hyphens.
	return preg_replace( '/[^A-Za-z0-9\-]/', '', $string ); // Removes special chars.
}

/**
 * Add shortcodes from New Era theme (legacy)
 *
 * Needed to get old articles to work properly.
 *
 * @package newera
 * @param Atts    $atts Attributes.
 * @param Content $content $atts Content.
 */
function youtube_audio_func( $atts, $content = null ) {
	return '<iframe width="640" height="35" src="//www.youtube.com/embed/' . $content . '?modestbranding=1&fs=0&iv_load_policy=3&rel=0&showinfo=0&theme=light&color=white&autohide=0&disablekb=1" frameborder="0" allowfullscreen></iframe>';
}

add_shortcode( 'youtube_audio', 'youtube_audio_func' );

function youtube_video_func( $atts, $content = null ) {
	return '<iframe class="youtube_video" width="853" height="480" src="https://www.youtube.com/embed/' . $content . '?vq=hd720&modestbranding=1&iv_load_policy=3&rel=0&showinfo=0&theme=light&color=white&cc_load_policy=1" frameborder="0"></iframe>';
}

add_shortcode( 'youtube_video', 'youtube_video_func' );

function facebook_embed_func( $atts ) {
	extract(
		shortcode_atts(
			array(
				'href' => '',
			), $atts
		)
	);
	return '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fi_FI/sdk.js#xfbml=1&appId=250821831708650&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>
<div class="fb-post" data-href="' . $href . '" data-width="640"></div>
';
}

add_shortcode( 'facebook_embedded_post', 'facebook_embed_func' );

function spotifyplay_func( $atts ) {
	extract(
		shortcode_atts(
			array(
				'src' => '',
				'width' => '500px',
				'height' => '580px',
				'theme' => 'black',
			), $atts
		)
	);
	return '<iframe src="https://embed.spotify.com/?uri=' . $src . '" width="500" height="580" style="width:' . $width . 'px;height:' . $height . ';" frameborder="0" allowtransparency="true"></iframe>';
}

add_shortcode( 'spotify-play', 'spotifyplay_func' );

/**
 * Minimize HTML (inc/cache-*)
 *
 * @param Buffer $buffer Buffer parameter.
 */
function sanitize_output( $buffer ) {

	$search = array(
		'/\>[^\S ]+/s',     // strip whitespaces after tags, except space
		'/[^\S ]+\</s',     // strip whitespaces before tags, except space
		'/(\s)+/s',         // shorten multiple whitespace sequences
	);

	$replace = array(
		'>',
		'<',
		'\\1',
		'',
	);

	$buffer = preg_replace( $search, $replace, $buffer );

	return $buffer;
}
ob_start( 'sanitize_output' );

/**
 * Wrap every image in post with a div
 *
 * @param Content $content Defines the content.
 * @link http://wordpress.stackexchange.com/questions/36000/wrap-all-post-images-inside-a-div-element
 */
function wrapimageswithdiv( $content ) {

	// A regular expression of what to look for.
	$pattern = '/(<img .*?class="(.*?photoblog.*?)"([^>]*)>)/i';
	// What to replace it with. $1 refers to the content in the first 'capture group', in parentheses above
	$replacement = '<div class="entry-photo">$1</div>';

	// Run preg_replace() on the $content
	$content = preg_replace( $pattern, $replacement, $content );

	// Return the processed content
	return $content;
}
add_filter( 'the_content', 'wrapimageswithdiv' );

/**
 * Calculate age function
 *
 * @param birthdate $birthdate Birthdate.
 */
function khonsu_calculate_age( $birthdate ) {
	list( $year, $month, $day ) = explode( '/', $birthdate );
	$yeardiff = date( 'Y' ) - $year;

	if ( date( 'm' ) < $month || (date( 'm' ) === $month && date( 'd' ) < $day ) ) {
		$yeardiff--;
	}

	return $yeardiff;
}

/**
 * Remove useless YARPP stylesheets
 *
 * @link https://wordpress.org/support/topic/prevent-loading-relatedcss-and-widgetcss
 */
function khonsu_deregister_plugin_assets_header() {
	wp_dequeue_style( 'yarppWidgetCss' );
	wp_deregister_style( 'yarppRelatedCss' );
}
add_action( 'wp_print_styles', 'khonsu_deregister_plugin_assets_header' );

function khonsu_deregister_plugin_assets_footer() {
	wp_dequeue_style( 'yarppRelatedCss' );
}
add_action( 'wp_footer', 'khonsu_deregister_plugin_assets_footer' );

/**
 * Custom pagination
 */
function khonsu_pagination() {
	global $wp_query;

	$big = 999999999; // Need an unlikely integer

	$paginate_links = paginate_links(
		array(
			'base'        => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'      => '?paged=%#%',
			'current'     => max( 1, get_query_var( 'paged' ) ),
			'total'       => $wp_query->max_num_pages,
			'prev_text'   => __( '&larr; uudempia' ),
			'next_text'   => __( 'vanhempia &rarr;' ),
		)
	);

	echo '<p class="custom-pagination">' . $paginate_links . '</p>';
}

/**
 * Count all words
 *
 * @param author $author Author.
 */
function post_word_count_by_author( $author = false ) {
	global $wpdb;
	$now = gmdate( 'Y-m-d H:i:s', time() );

	if ( $author ) :
		$query = "SELECT post_content FROM $wpdb->posts WHERE post_author = '$author' AND post_status= 'publish' AND post_date < '$now'";
  else :
		$query = "SELECT post_content FROM $wpdb->posts WHERE post_status = 'publish' AND post_date < '$now'";
  endif;

	$words = $wpdb->get_results( $query );
	if ( $words ) {
		foreach ( $words as $word ) {
			$post = strip_tags( $word->post_content );
			$post = explode( ' ', $post );
			$count = count( $post );
			$totalcount = $count + $oldcount;
			$oldcount = $totalcount;
		}
	} else {
		$totalcount = 0;
	}

	return number_format( $totalcount );
}

/**
 * Dude Instagram hashtag feed.
 */
add_filter(
	'dude-insta-feed/access_token/user=30821744', function() {
		return getenv( 'INSTAGRAM_ACCESS_TOKEN' );
	}
);

/**
 * Untappd credentials
 */
add_filter(
	'dude-untappd/client_id/user=rolle', function() {
		return getenv( 'UNTAPPD_CLIENT_ID' );
	}
);

add_filter(
	'dude-untappd/client_secret/user=rolle', function() {
		return getenv( 'UNTAPPD_CLIENT_SECRET' );
	}
);

/**
 * Limit Instagram feed items
 */
add_filter(
	'dude-insta-feed/user_images_parameters', function( $parameters ) {
		$parameters['count'] = '4';
		return $parameters;
	}
);

/**
 * Estimate time required to read the article
 *
 * @return string
 */
function khonsu_estimated_reading_time() {

	$post = get_post();
	$words = str_word_count( strip_tags( $post->post_content ) );
	$minutes = floor( $words / 120 );
	$seconds = floor( $words % 120 / ( 120 / 60 ) );

	if ( 1 <= $minutes ) :
		if ( 1 === $minutes ) :
			$estimated_time = $minutes . ' min';
		else :
			$estimated_time = $minutes . ' min';
		endif;
  else :
		$estimated_time = 'Alle 1 min';
  endif;

	return '<span class="time-to-read">' . $estimated_time . ' lukukokemus</span>';
}

/**
 * Random image url function
 */
function khonsu_get_random_image_url() {
	$query = get_posts(
		array(
			'post_status'     => 'inherit',
			'post_type'       => 'attachment',
			'post_mime_type'  => 'image/jpeg,image/gif,image/jpg,image/png',
			'posts_per_page'  => 1,
			'category_name'   => 'kuvituskuva',
			'no_found_rows'   => true,
			'orderby'         => 'rand',
		)
	);

	if ( ! empty( $query ) ) {
		$return = '';

		foreach ( $query as $attachment ) {
			$return = wp_get_attachment_url( $attachment->ID );
		}
	}
	return $return;
}

/**
 * Media library taxonomy for photo bank
 */
add_action( 'init', 'photobank_attachment_taxonomies' );
function photobank_attachment_taxonomies() {

	$taxonomies = array( 'category' );
	foreach ( $taxonomies as $tax ) {
		register_taxonomy_for_object_type( $tax, 'attachment' ); // Add to post type attachment
	}
}

/**
 * Enable theme support for essential features.
 */
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

/**
 * Locales
 */
setlocale( LC_ALL, 'fi_FI.UTF-8' );
setlocale( LC_TIME, 'fi_FI.UTF-8' );
ini_set( 'intl.default_locale', 'fi_FI' );
date_default_timezone_set( 'Europe/Helsinki' );

/**
 * Define SendGrid credentials
 */
define( 'SENDGRID_API_KEY', getenv( 'SENDGRID_API_KEY' ) );
define( 'SENDGRID_CATEGORIES', 'rollemaa' );

/**
 * Allow most read posts to calculate monthly and weekly posts
 */
add_filter( 'dmrp_count_day' , 'khonsu_dmrp_count_day' );
function khonsu_dmrp_count_day() {
	return true;
}

add_filter( 'dmrp_count_month' , 'khonsu_dmrp_count_month' );
function khonsu_dmrp_count_month() {
	return true;
}

add_filter( 'dmrp_count_week' , 'khonsu_dmrp_count_week' );
function khonsu_dmrp_count_week() {
	return true;
}

add_filter( 'dmrp_count_year' , 'khonsu_dmrp_count_year' );
function khonsu_dmrp_count_year() {
	return true;
}

/**
 * Load textdomain and set a locale.
 */
load_theme_textdomain( 'khonsu', get_template_directory() . '/languages' );
setlocale( LC_ALL, 'fi_FI.utf8' );

/**
 * Enqueue scripts and styles.
 */
function khonsu_scripts() {
	$khonsu_template = 'global';

	// Styles.
	wp_enqueue_style( 'styles', get_theme_file_uri( "css/{$khonsu_template}.css" ), array(), filemtime( get_theme_file_path( "css/{$khonsu_template}.css" ) ) );

	// Scripts.
	wp_enqueue_script( 'jquery-core' );
	wp_enqueue_script( 'scripts', get_theme_file_uri( 'js/all.js' ), array(), filemtime( get_theme_file_path( 'js/all.js' ) ), true );
	wp_localize_script(
		'scripts', 'dynamicFooter', array(
			'url' => get_template_directory_uri() . '/template-parts/dynamic-footer.php',
			'lastfm' => get_template_directory_uri() . '/template-parts/lastfm-dynamic.php',
		)
	);

}
add_action( 'wp_enqueue_scripts', 'khonsu_scripts' );
