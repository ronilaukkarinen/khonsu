<?php
/**
 * Template Name: Info
 *
 * @package khonsu
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<div class="container container-narrow">
			<?php while ( have_posts() ) {
				the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Tietoa minusta ja sivustosta', 'khonsu' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content template-info">

						<h2><?php _e( 'Kuka Rolle?', 'khonsu' ); ?></h2>

						<?php if ( has_post_thumbnail() ) : ?>
							<div class="author-image">
								<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" alt="Rolle" />

								<div class="author-image-caption">
									<p><?php the_post_thumbnail_caption(); ?></p>
								</div>
							</div>
							<?php endif;

							the_content(); ?>

							<p><?php _e( 'Hei vaan! Selaat henkilökohtaista blogiani, joka on yksi sadoista sivuista, joita olen toteuttanut. Omia sivustoja minulla on kymmenkunta. Minä olen Roni "Rolle" Laukkarinen, jyväskyläläinen digialan yrittäjä/<a href="http://www.dude.fi" target="_blank">dude</a>, hevimies ja pitkän linjan elämäntapanörtti. Olen harrastellut fanaattisesti tietokoneita jo pikkupojasta ja ensimmäisiä nettisivujani julkaisin 90-luvun loppupuolella, jolloin olin noin kymmenvuotias. Keväästä 2013 lähtien olen ollut yrittäjä omassa yrityksessäni, <a href="http://www.dude.fi" target="_blank">Digitoimisto Dude Oy</a>:ssa, jossa teen sitä mistä eniten tykkään ja mitä parhaiten osaan - nettisivuja- ja muita netissä toimivia palveluita.', 'khonsu' ); ?></p>

							<p><?php _e( 'Toinen puoli elämästäni sisältää raskasta metallimusiikkia ja onpa jokunen kirjoitus tullut kirjoitettua myös ammatillisella puolella, <a href="http://www.metallimusiikki.net" target="_blank">Metallimusiikki.netin verkkolehdessä</a>, jonka toimituksessa olen ollut vuodesta 2007. Muita harrastuksiani ovat <a href="'.get_home_url().'/avainsana/musiikki">musiikki</a> muussakin muodossa, <a href="'.get_home_url().'/leffat">elokuvien harrastaminen</a>, sekä tietenkin tietokoneet ja kaikki niihin liittyvä. Tykkään myös hyvästä oluesta, josta bloggaan <a href="http://www.huurteinen.fi">keväällä 2014 perustamassani Huurteinen.fi -olutblogissa</a>.', 'khonsu' ); ?></p>

							<p><?php _e( 'Arkeni kuluu <a href="'.get_home_url().'/avainsana/viittomakieli">viittomakielisessä</a> ympäristössä, ja elämä on haasteita täynnä vaimon <a href="'.get_home_url().'/avainsana/kuurosokeus">kuurosokeutta</a> aiheuttavan sairauden kanssa. Menneisyydessä on myös joutunut kamppailemaan omaa ja puolison <a href="'.get_home_url().'/avainsana/masennus">masennukseksi</a> diagnisoitua mielisairautta vastaan. Rollemaan lisäksi vaikutan pitkin Internetin pientä maailmaa ja minut löytää aika lailla kaikkialta netissä.', 'khonsu' ); ?></p>

							<?php include( TEMPLATEPATH . '/template-parts/ads-google-middle.php' ); ?>	  	

							<h2><?php _e( 'Bloggaaminen', 'khonsu' ); ?></h2>

							<p><?php _e( 'Blogia olen kirjoittanut jotakuinkin vuodesta 2000 ja sitä ennen olen koko pienen elämäni kirjoittanut päiväkirjoja ja muitakin tekstejä. Nuorempana tuli kirjoitettua jopa novelleja ja runoja, joista joitakin julkaistiin lehdissäkin. Blogissa tekstini tuppaavat aina paisumaan, koska tykkään kirjoittaa.', 'khonsu' ); ?></p>

							<p><?php _e( 'Rollemaa on ollut olemassa melkein yhtä pitkään kuin minäkin. Ennen Rollemaata sivusto kulki nimellä Rolleweb.net (kyllä, 10-vuotiaan nulikan hyvin omaperäinen päähänpisto - netti oli täynnä Markonettiä, Jonnewebiä, Anttinetiä, Jarmonetiä ja ties mitä Masanetiä siihen aikaan). Domainin kuitenkin myi törkeästi eteenpäin silloinen palveluntarjoajani, konkurssiin mennyt Futuron Internet. Sain kuitenkin suurimman osan vanhoistakin kirjoituksista palautettua varmuuskopioista, joten tarinan voit lukea täältäkin, avainsanan <a href="'.get_home_url().'/avainsana/rolleweb">rolleweb</a> alta.', 'khonsu' ); ?></p>

							<p><?php _e( 'Kaiken tarpeellisen tiedon – ja ehkä vähän enemmänkin – saat kyllä tietää lukemalla blogiani. Siitä vaan penkomaan läpi '.wp_count_posts()->publish.' artikkelia. Rollemaa on oma "virtuaalinen puistoni", jossa kirjoittelen milloin mistäkin mielenkiinnon kohteestani. Toivottavasti viihdyt!', 'khonsu' ); ?></p>

							<h2><?php _e( 'Muut blogini', 'khonsu' ); ?></h2>

							<p><?php _e( 'Rollemaa ei ole ainoa paikka, jonne bloggaan. Kirjoittelen epäsäännöllisen säännöllisesti myös ainakin seuraaviin blogeihin:', 'khonsu' ); ?></p>

							<ul>
								<li><s><a href="https://www.rollemaa.fi/pikkuinen"><?php _e( 'Pikkuisen oma blogi', 'khonsu' ); ?></a> - <?php _e( 'Lasteni blogi', 'khonsu' ); ?></s></li>
								<li><a href="https://www.rollemaa.fi/leffat"><?php _e( 'Rollen leffat', 'khonsu' ); ?></a> - <?php _e( 'Kevyitä elokuva-arvosteluja', 'khonsu' ); ?></li>
								<li><a href="https://unet.rollemaa.fi"><?php _e( 'Rollen unipäiväkirja', 'khonsu' ); ?></a> - <?php _e( 'Nähtyjä unia', 'khonsu' ); ?></li>
								<li><s><a href="https://www.adminlabs.com/blogi"><?php _e( 'AdminLabs (ennen problemsolv.in)', 'khonsu' ); ?></a> - <?php _e( 'Englanninkielinen tietotekniikka-ongelmanratkaisublogi', 'khonsu' ); ?></s></li>
								<li><a href="https://www.dude.fi/blogi"><?php _e( 'Digitoimisto Dude Oy', 'khonsu' ); ?></a> - <?php _e( 'Yritykseni blogi', 'khonsu' ); ?></li>
								<li><a href="https://www.huurteinen.fi"><?php _e( 'Huurteinen.fi', 'khonsu' ); ?></a> - <?php _e( 'Huhtikuussa 2014 perustettu olutblogi', 'khonsu' ); ?></li>
								<li><s><a href="https://www.pulina.fi"><?php _e( 'Pulina.fi', 'khonsu' ); ?></a> - <?php _e( 'Perustamani aktiivisen suomalaisen IRC-kanavan sivut', 'khonsu' ); ?></s></li>
								<li><a href="https://medium.com/@rolle"><?php _e( 'Rolle @medium', 'khonsu' ); ?></a> - <?php _e( 'Huhtikuussa 2015 aloitettu englanninkielinen blogini (Medium)', 'khonsu' ); ?></li>
								<li><a href="https://geekylifestyle.com"><?php _e( 'Geeky Lifestyle', 'khonsu' ); ?></a> - <?php _e( 'Kansainvälinen nörttiblogini.', 'khonsu' ); ?></li>
							</ul>

							<h2><?php _e( 'Yhteystiedot', 'khonsu' ); ?></h2>

							<p><?php _e( 'Minut tavoittaa parhaiten netistä. Olen rekisteröitynyt yli 60 sosiaalisen median palveluun, joista eniten käytän <a href="http://twitter.com/rolle">Twitteriä</a>. Paljon vaivaa ei tarvitse nähdä jos minuun haluaa saada yhteyttä, sillä yhteystietoni löytyvät netistä jo varmasti osoitetta ja puhelinnumeroa myöten parin klikkauksen kautta. Ota rohkeasti yhteyttä, jos on asiaa! Tweettaa tai <a href="mailto:roni.laukkarinen@gmail.com">pistä sähköpostia</a> (työasioissa <a href="mailto:roni@dude.fi">roni@dude.fi</a>).', 'khonsu' ); ?></p>

							<p><?php _e( 'Rollemaa löytyy muuten <a href="http://www.facebook.com/rollemaa">Facebookistakin</a>, mutta sinne tulee lähinnä Instagram-kuvia ja uusia bloggauksia. Jos tahdot pysyä kärryillä sitäkin kautta, <a href="http://www.facebook.com/rollemaa">tykkää ihmeessä</a>.', 'khonsu' ); ?></p>

						</div><!-- .entry-content -->

						<?php if ( get_edit_post_link() ) { ?>
						<footer class="entry-footer">
							<?php edit_post_link(
								sprintf(
									/* translators: %s: Name of current post */
									esc_html__( 'Muokkaa %s', '_s' ),
									the_title( '<span class="screen-reader-text">"', '"</span>', false )
								),
								'<span class="edit-link">',
								'</span>'
								); ?>
							</footer><!-- .entry-footer -->
							<?php } ?>
						</article><!-- #post-## -->

						<?php } ?>
					</div><!-- .container -->

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_footer();
