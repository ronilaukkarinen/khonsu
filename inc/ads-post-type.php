<?php
/**
 * Advertisement post type
 *
 * @package khonsu
 */

// Register Custom Post Type
function khonsu_ads() {

  $labels = array(
    'name'                  => _x( 'Mainokset', 'Post Type General Name', 'khonsu' ),
    'singular_name'         => _x( 'Mainos', 'Post Type Singular Name', 'khonsu' ),
    'menu_name'             => __( 'Mainokset', 'khonsu' ),
    'name_admin_bar'        => __( 'Mainokset', 'khonsu' ),
    'archives'              => __( 'Mainos-arkistot', 'khonsu' ),
    'attributes'            => __( 'Mainoksen attribuutit', 'khonsu' ),
    'parent_item_colon'     => __( 'Isäntämainos:', 'khonsu' ),
    'all_items'             => __( 'Kaikki mainokset', 'khonsu' ),
    'add_new_item'          => __( 'Lisää mainos', 'khonsu' ),
    'add_new'               => __( 'Lisää mainos', 'khonsu' ),
    'new_item'              => __( 'Uusi mainos', 'khonsu' ),
    'edit_item'             => __( 'Muokkaa mainosta', 'khonsu' ),
    'update_item'           => __( 'Päivitä mainos', 'khonsu' ),
    'view_item'             => __( 'Katso mainos', 'khonsu' ),
    'view_items'            => __( 'Katso mainoksia', 'khonsu' ),
    'search_items'          => __( 'Etsi mainos', 'khonsu' ),
    'not_found'             => __( 'Ei löydy', 'khonsu' ),
    'not_found_in_trash'    => __( 'Ei löydy roskista', 'khonsu' ),
    'featured_image'        => __( 'Artikkelikuva', 'khonsu' ),
    'set_featured_image'    => __( 'Aseta artikkelikuva', 'khonsu' ),
    'remove_featured_image' => __( 'Poista artikkelikuva', 'khonsu' ),
    'use_featured_image'    => __( 'Käytä artikkelikuvana', 'khonsu' ),
    'insert_into_item'      => __( 'Lisää kohteeseen', 'khonsu' ),
    'uploaded_to_this_item' => __( 'Lisätty kohteeseen', 'khonsu' ),
    'items_list'            => __( 'Mainoslista', 'khonsu' ),
    'items_list_navigation' => __( 'Mainoslistan navigointi', 'khonsu' ),
    'filter_items_list'     => __( 'Suodata listaa', 'khonsu' ),
  );
  $args = array(
    'label'                 => __( 'Mainos', 'khonsu' ),
    'description'           => __( 'Ad slots', 'khonsu' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'revisions', 'post-formats', ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-forms',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,   
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'ads', $args );

}
add_action( 'init', 'khonsu_ads', 0 );
