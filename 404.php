<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package khonsu
 */

get_header(); ?>

<section class="not-found">

	<div class="shade shade-gradient"></div>
	<div class="video-container">
		<video loop muted autoplay poster="<?php echo get_template_directory_uri(); ?>/video/trees.jpg">
			<source src="<?php echo get_template_directory_uri(); ?>/video/trees.mp4" type="video/mp4">
			<source src="<?php echo get_template_directory_uri(); ?>/video/trees.webm" type="video/webm">
		</video>
	</div>

	<div class="container">
		<h1><?php echo esc_html_e( 'Sivua ei löydy', 'khonsu' ); ?></h1>
		<p><?php echo esc_html_e( 'Etsimääsi sivua ei ole olemassa, se on saatettu poistaa tai siirtää. Jos epäilet kyseessä olevan virhe,', 'khonsu' ); ?> <a href="mailto:roni.laukkarinen@gmail.com"><?php echo esc_html_e( 'ota yhteyttä Rolleen sähköpostitse', 'khonsu' ); ?></a>. <a href="<?php echo get_home_url(); ?>">Tästä etusivulle</a>.</p>
	</div><!-- .container -->
</section>

<?php get_footer();
