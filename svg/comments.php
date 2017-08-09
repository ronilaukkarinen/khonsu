<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package khonsu
 */

 /*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>

<div class="comments-wrap">
<div id="comments" class="comments-area">

  <?php

  // Custom comment form
  $commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );

  $args = array(
    'title_reply'          => '<a name="kommentoi" id="kommentoi"></a><span class="responses">'.__( 'Reaktiot', 'khonsu' ).'</span>',
    'label_submit'         => __( 'Lähetä kommentti', 'khonsu' ),
    'comment_notes_before' => ''.__( '', 'khonsu' ).'',
    'comment_field'        => '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">'._x( 'Kommentti', 'noun' ).'</label><textarea id="comment" placeholder="'.__( 'Kirjoita kommenttisi tähän.', 'khonsu' ).'" name="comment" cols="45" rows="3" aria-required="true"></textarea></p><div class="hidden-by-default">',
    'fields'               => apply_filters( 'comment_form_default_fields', array(
      'author'  => '<p class="comment-form-author">'.'<label class="screen-reader-text" for="author">'.__( 'Nimesi', 'khonsu' ).'</label> '.( $req ? '<span class="required screen-reader-text">Vaadittu kenttä</span>' : '' ).'<input id="author" name="author" placeholder="'.__( 'Nimesi', 'khonsu' ).'" type="text" value="'.esc_attr( $commenter['comment_author'] ).'" size="30"'.$aria_req.' /></p>',
      'email'   => '<p class="comment-form-email"><label class="screen-reader-text" for="email">'.__( 'Sähköpostiosoite (vaaditaan, mutta ei julkaista)', 'khonsu' ).'</label> '.( $req ? '<span class="required screen-reader-text">Vaadittu kenttä</span>' : '' ).'<input id="email" name="email" placeholder="'.__( 'Sähköpostiosoite (vaaditaan, mutta ei julkaista)', 'khonsu' ).'" type="text" value="'.esc_attr(  $commenter['comment_author_email'] ).'" size="30"'.$aria_req.' /></p>',
      'url'     => '<p class="comment-form-url"><label class="screen-reader-text" for="url">'.__( 'Verkkosivusi (jos haluat)', 'khonsu' ).'</label>'.'<input id="url" name="url" placeholder="'.__( 'http://', 'khonsu' ).'" type="text" value="'.esc_attr( $commenter['comment_author_url'] ).'" size="30" /></p></div>',
    ) )
  );

  comment_form( $args );

  if ( have_comments() ) : ?>
    <h2 class="comments-title screen-reader-text">
      <?php
        printf( // WPCS: XSS OK.
          esc_html( _nx( '%1$s kommentti', '%1$s kommenttia', get_comments_number(), 'comments title', 'khonsu' ) ),
          number_format_i18n( get_comments_number() ),
          '<span class="screen-reader-text">on article "' . get_the_title() . '"</span>'
        );
      ?>
    </h2>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
      <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'khonsu' ); ?></h2>
      <div class="nav-links">

        <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'khonsu' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'khonsu' ) ); ?></div>

      </div><!-- .nav-links -->
    </nav><!-- #comment-nav-above -->
    <?php endif; // Check for comment navigation. ?>

    <ol class="comment-list">
      <?php
        wp_list_comments( array(
          'style'      => 'ol',
          'short_ping' => true,
          'callback' => 'khonsu_comments',
        ) );
      ?>
    </ol><!-- .comment-list -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
      <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'khonsu' ); ?></h2>
      <div class="nav-links">

        <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'khonsu' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'khonsu' ) ); ?></div>

      </div><!-- .nav-links -->
    </nav><!-- #comment-nav-below -->
    <?php
    endif; // Check for comment navigation.

  endif; // Check for have_comments().


  // If comments are closed and there are comments, let's leave a little note, shall we?
  if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'khonsu' ); ?></p>
  <?php
  endif;  
  ?>

</div><!-- #comments -->
</div>
