<?php
/**
 * GitHub commits.
 *
 * @package khonsu
 */

$github_url = 'https://github.com/ronilaukkarinen/khonsu/commits/master.atom';
$github_cachefile = get_theme_file_path( 'inc/cache/github.xml' );
$github_cachetime = 10800; // Three hours
?>

<?php
if ( strpos( file_get_contents( $github_url ), '<?xml' ) !== false ) :

// If cache file does not exist, let's create it
if ( ! file_exists( $github_cachefile ) ) {
  copy( $github_url, $github_cachefile );
}

// Serve from the cache if it is younger than $github_cachetime
if ( file_exists( $github_cachefile ) && time() - $github_cachetime < filemtime( $github_cachefile ) ) :
  // Do nothing, it's cached
else :
  // If time ran out, copy over
  copy( $github_url, $github_cachefile );
endif;

  $rss = simplexml_load_file( $github_cachefile );
  $updated_processed = explode( 'T', $rss->entry->updated );
  $updated = $updated_processed[0];

  foreach ( $rss->entry->link as $link ) :
   $self_link = (string) $link['href'];
   ?><a href="<?php echo $self_link; ?>"><?php echo $updated; ?></a><?php endforeach;

endif;
