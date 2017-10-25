<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package khonsu
 */

?>

</div><!-- #content -->

<?php
if ( is_front_page() && ! is_paged() ) :
  get_template_part( 'template-parts/dynamic-footer' );
else :
?>

<div class="loader-stuff">
  <button type="button" aria-pressed="false" class="load-dynamic-footer"><?php echo esc_html_e( 'Näytä höttöinfot', 'khonsu' ); ?></button>

  <div id="loading">
    <div class="loader">
      <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
      </svg>
    </div>
  </div>    
</div>
<div id="dynamic-footer"></div>

<?php
endif;
?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
