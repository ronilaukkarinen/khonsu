<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package khonsu
 */

get_header();

get_template_part('template-parts/hero', get_post_type()); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">
    <div class="container container-archive">

      <?php if ( have_posts() ) :
      $count = 0; ?>

      <div class="notification-box">
        <?php if ( is_tag() ) : ?>
          <h3>Arkisto avainsanalle &quot;<?php echo single_tag_title( '', false ); ?>&quot;</h3>

          <p>Avainsanalla &quot;<?php echo single_tag_title( '', false ); ?>&quot; tägättyjä artikkeleja Rollemaassa on tällä hetkellä yhteensä huimat <?php $tag = $wp_query->get_queried_object();
          echo $tag->count; ?> kpl.</strong></p>
        <?php endif; ?>

        <?php if ( is_category() ) : ?>

          <h3>Kirjoitukset kategoriassa &quot;<?php echo single_cat_title(); ?>&quot;</h3>
          <p>Aihealueeseen &quot;<?php echo single_cat_title(); ?>&quot; liittyvää on kirjoiteltu yhteensä <?php $cat = get_the_category();
          $cat = $cat[0];
          echo $cat->category_count; ?> kpl.</p>

        <?php elseif ( is_day() ) : ?>

          <?php
          $current_month = get_the_time( 'm' );
          $current_year = get_the_time( 'Y' );
          $current_day = get_the_time( 'j' );
          $countposts = get_posts('year=$current_year&monthnum=$current_month&day=$current_day');
          ?>

          <h3><?php echo ucfirst(get_the_time('l')) ?>, <?php the_time('j.') ?> <?php the_time('F') ?>ta <?php the_time('Y') ?></h3>
          <p>Kaikki <?php echo ucfirst(get_the_time('l')) ?>na, <?php the_time('j.') ?> <?php the_time('F') ?>ta <?php the_time('Y') ?> julkaisemani kirjoitukset näet tällä sivulla. Kirjoituksia kertyi yhteensä <?php echo count($countposts); ?>.</p>

        <?php elseif ( is_month() ) : ?>

          <?php
          $current_month = get_the_time('m');
          $current_year = get_the_time('Y');
          $countposts=get_posts( 'year=$current_year&monthnum=$current_month' );
          ?>

          <h3><?php echo ucfirst(get_the_time('F')) ?>, <?php the_time('Y') ?></h3>
          <p><?php echo ucfirst(get_the_time('F')) ?>ssa vuonna <?php the_time('Y') ?> naputtelin kirjoituksia yhteensä huimat <?php echo count($countposts); ?> kpl. Tällä sivulla näet ne kaikki kätevästi listattuna.</p>

        <?php elseif ( is_year() ) : ?>

          <h3>Anno domini <?php the_time('Y'); ?></h3>
          <p>Herran vuonna <?php the_time('Y'); ?> kirjoitetut artikkelit.</p>

        <?php elseif ( is_search() ) : ?>

          <h1>Hakutulokset</h1>
          <h3><?php $cat = get_the_category();
          $cat = $cat[0];
          echo $cat->category_count; ?> löytyi!</h3>

        <?php elseif ( is_author() ) : ?>

          <h1><?php echo $curauth->nickname; ?>n kirjoittamat</h1>
          <h3><?php $cat = get_the_category();
          $cat = $cat[0];
          echo $cat->category_count; ?> kpl</h3>

        <?php endif; ?>
      </div><!-- .notification-box -->

      <?php while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/content' );
      endwhile;

      khonsu_pagination();

    else :
      get_template_part( 'template-parts/content', 'none' );
    endif; ?>

    </div><!-- .container -->

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
