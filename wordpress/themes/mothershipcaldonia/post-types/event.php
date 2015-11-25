<?php
/**
 * Mothership Caldonia event post type.
 *
 * @link http://www.smashingmagazine.com/2015/04/extending-wordpress-custom-content-types/
 *
 * @package Mothership_Caldonia
 */

class mc_event {

  function __construct() {
    add_action('init', array($this, 'create_post_type'));
    add_action('init', array($this, 'create_taxonomies'));
    add_action('manage_mc_event_posts_columns', array($this, 'columns'), 10, 2);
    add_action('manage_mc_event_posts_custom_column', array($this, 'column_data'), 11, 2);
    add_filter('posts_join', array($this, 'join'), 10, 1);
    add_filter('posts_orderby', array($this, 'set_default_sort'), 20, 2);
  }

  function create_post_type() {
    $labels = [
      'name'                  => _x('Events', 'Post Type General Name', 'mc'),
      'singular_name'         => _x('Event', 'Post Type Singular Name', 'mc'),
      'menu_name'             => __('Events', 'mc'),
      'name_admin_bar'        => __('Event', 'mc'),
      'parent_item_colon'     => __('Parent Event:', 'mc'),
      'all_items'             => __('All Events', 'mc'),
      'add_new_item'          => __('Add New Event', 'mc'),
      'add_new'               => __('Add New', 'mc'),
      'new_item'              => __('New Event', 'mc'),
      'edit_item'             => __('Edit Event', 'mc'),
      'update_item'           => __('Update Event', 'mc'),
      'view_item'             => __('View Event', 'mc'),
      'search_items'          => __('Search Events', 'mc'),
      'not_found'             => __('No Events Found', 'mc'),
      'not_found_in_trash'    => __('No Events Found in Trash', 'mc'),
      'items_list'            => __('Items list', 'mc'),
      'items_list_navigation' => __('Items list navigation', 'mc'),
      'filter_items_list'     => __('Filter items list', 'mc'),
    ];

    $args = [
      'label'                 => __('Event', 'mc'),
      'description'           => __('Post Type Description', 'mc'),
      'labels'                => $labels,
      'supports'              => ['title', 'author', 'thumbnail', 'trackbacks', 'revisions', 'post-formats'],
      'taxonomies'            => ['post_tag'],
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'menu_icon'             => 'dashicons-tickets-alt',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => 'events',
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'capability_type'       => 'post',
    ];

    register_post_type('mc_event', $args);
  }

  function create_taxonomies() {

  }

  function columns($columns) {

  }

  function column_data($column, $post_id) {

  }

  function join($wp_join) {

  }

  function set_default_sort($orderby, &$query) {

  }
}

new mc_event();
