<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package khonsu
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/icon-ipad.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/icon-ipad.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/icon-retina.png">

<?php wp_head(); ?>

<?php if ( is_singular() && ! has_tag( 'raha' ) ) : ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-8523880252818258",
    enable_page_level_ads: true
  });
</script>
<?php endif; ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'khonsu' ); ?></a>

  <?php if ( ! is_single() ) : ?>
    <header class="site-header" itemscope itemtype="http://schema.org/WPHeader">

    <?php if ( ! is_404() ) : ?>
    <div class="shade shade-gradient"></div><!-- .shade -->

      <div class="video-container">
        <video loop muted autoplay poster="<?php echo get_template_directory_uri(); ?>/video/trees.jpg">
          <source src="<?php echo get_template_directory_uri(); ?>/video/trees.mp4" type="video/mp4">
          <source src="<?php echo get_template_directory_uri(); ?>/video/trees.webm" type="video/webm">
        </video>
      </div>
      <?php endif; ?>

      <div class="header-inner<?php if ( is_404() ) : ?> screen-reader-text<?php endif; ?>">
        <div class="container">
          <div class="site-branding">
            <?php if ( is_front_page() && is_home() ) : ?>
              <h1 itemprop="headline" class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/logo.svg' ) ) ); ?></a></h1>
            <?php else : ?>
              <p itemprop="headline" class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span><?php echo file_get_contents( esc_url( get_theme_file_path( '/svg/logo.svg' ) ) ); ?></a></p>
            <?php endif;

            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
            <p itemprop="about" class="site-description screen-reader-text"><?php echo $description; /* WPCS: xss ok. */ ?></p>
          <?php endif; ?>
        </div><!-- .site-branding -->
      </div><!-- .container -->

      <?php if ( ! is_404() ) : ?>
      <div class="silver-lining">
        <div class="container">
          <nav id="nav">

            <?php wp_nav_menu( array(
              'theme_location'    => 'primary',
              'container'         => false,
              'depth'             => 4,
              'menu_class'        => 'menu-items',
              'menu_id'           => 'menu',
              'echo'              => true,
              'fallback_cb'       => 'wp_page_menu',
              'items_wrap'        => '<ul class="%2$s" id="%1$s">%3$s</ul>',
              'walker'            => new khonsu_Walker(),
              ) ); ?>

          </nav><!-- #site-navigation -->
        </div><!-- .container -->
      </div><!-- .silver-lining -->
      <?php endif; ?>
    </div><!-- .header-inner-->

    </header>
  <?php endif; ?>

  <div id="content" class="site-content">
