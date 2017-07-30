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

		<div class="column column-twitter">
			<h4><a href="#item-title">Päivitystä ladataan...</a></h4>
			<div class="meta">
				<div class="meta-avatar" style="background-image: url('<?php echo get_template_directory_uri() . '/images/avatar-twitter.jpg'; ?>');"></div>
				<div class="meta-title-stuff">
					<h5><a href="https://twitter.com/rolle"><?php echo esc_html_e( '@rolle Twitterissä', 'khonsu' ); ?></a></h5>
					<h6><time datetime="">Aikaa ladataan...</time></h6>
				</div>
			</div>
		</div>

		<div class="column column-huurteinen">
			<h4><a href="#item-title">Päivitystä ladataan...</a></h4>
			<div class="meta">
				<div class="meta-avatar" style="background-image: url('<?php echo get_template_directory_uri() . '/images/avatar-huurteinen.png'; ?>');"></div>
				<div class="meta-title-stuff">
					<h5><a href="https://www.huurteinen.fi"><?php echo esc_html_e( 'Huurteinen', 'khonsu' ); ?></a></h5>
					<h6><time datetime="">Aikaa ladataan...</time></h6>
				</div>
			</div>
		</div>

		<div class="column column-leffat">
			<h4><a href="#item-title">Päivitystä ladataan...</a></h4>
			<div class="meta">
				<div class="meta-avatar" style="background-image: url('<?php echo get_template_directory_uri() . '/images/avatar-leffat.png'; ?>');"></div>
				<div class="meta-title-stuff">
					<h5><a href="https://www.rollemaa.fi/leffat"><?php echo esc_html_e( 'Rollen leffablogi', 'khonsu' ); ?></a></h5>
					<h6><time datetime="">Aikaa ladataan...</time></h6>
				</div>
			</div>
		</div>

		<div class="column column-geekylifestyle">
			<h4><a href="#item-title">Päivitystä ladataan...</a></h4>
			<div class="meta">
				<div class="meta-avatar" style="background-image: url('<?php echo get_template_directory_uri() . '/images/avatar-geekylifestyle.jpg'; ?>');"></div>
				<div class="meta-title-stuff">
					<h5><a href="https://geekylifestyle.com"><?php echo esc_html_e( 'Rollen leffablogi', 'khonsu' ); ?></a></h5>
					<h6><time datetime="">Aikaa ladataan...</time></h6>
				</div>
			</div>
		</div>

		<div class="column column-medium">
			<h4><a href="#item-title">Päivitystä ladataan...</a></h4>
			<div class="meta">
				<div class="meta-avatar" style="background-image: url('<?php echo get_template_directory_uri() . '/images/avatar-medium.png'; ?>');"></div>
				<div class="meta-title-stuff">
					<h5><a href="https://medium.com/@rolle"><?php echo esc_html_e( 'Stories by Roni Laukkarinen on Medium', 'khonsu' ); ?></a></h5>
					<h6><time datetime="">Aikaa ladataan...</time></h6>
				</div>
			</div>
		</div>

		<div class="column column-dude">
			<h4><a href="#item-title">Päivitystä ladataan...</a></h4>
			<div class="meta">
				<div class="meta-avatar" style="background-image: url('<?php echo get_template_directory_uri() . '/images/avatar-dude.png'; ?>');"></div>
				<div class="meta-title-stuff">
					<h5><a href="https://www.dude.fi/blogi"><?php echo esc_html_e( 'Digitoimisto Dude', 'khonsu' ); ?></a></h5>
					<h6><time datetime="">Aikaa ladataan...</time></h6>
				</div>
			</div>
		</div>

	</div><!-- .content -->
</div><!-- .block -->
