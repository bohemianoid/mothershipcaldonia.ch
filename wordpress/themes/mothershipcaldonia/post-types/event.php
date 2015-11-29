<?php
/**
 * Mothership Caldonia event post type.
 *
 * @link http://www.smashingmagazine.com/2015/04/extending-wordpress-custom-content-types/
 * @link https://generatewp.com/post-type/
 *
 * @package Mothership_Caldonia
 */

class mc_event {

  function __construct() {
    add_action('init', [$this, 'create_post_type']);
    add_action('init', [$this, 'create_taxonomies']);
    add_action('manage_mc_event_posts_columns', [$this, 'columns'], 10, 2);
    add_action('manage_mc_event_posts_custom_column',
               [$this, 'column_data'], 11, 2);
    add_filter('posts_join', [$this, 'join'], 10, 1);
    add_filter('posts_orderby', [$this, 'set_default_sort'], 20, 2);
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

    $rewrite = [
      'slug'                  => 'events',
      'with_front'            => true,
      'pages'                 => true,
      'feeds'                 => true,
    ];

    $args = [
      'label'                 => __('Event', 'mc'),
      'description'           => __('Post Type Description', 'mc'),
      'labels'                => $labels,
      'supports'              => ['title', 'editor', 'author', 'thumbnail',
                                  'revisions'],
      'taxonomies'            => ['post_tag'],
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'menu_icon'             => 'dashicons-calendar-alt',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => 'events',
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'rewrite'               => $rewrite,
      'capability_type'       => 'post',
    ];

    register_post_type('mc_event', $args);
  }

  function create_taxonomies() {

  }

  function columns($columns) {
    unset($columns['author']);
    unset($columns['date']);

    return array_merge(
    $columns,
    [
      'mc_event_date' => 'Date'
    ]);
  }

  function column_data($column, $post_id) {
    switch($column) {
      case 'mc_event_date' :
        $date = DateTime::createFromFormat(
          'Ymd', get_post_meta($post_id, 'acf_mc_event_date', 1)
        );
        echo $date->format('d. F Y');
        break;
    }
  }

  function join($wp_join) {
    global $wpdb;
    if(get_query_var('post_type') == 'mc_event') {
      $wp_join .= " LEFT JOIN (
                      SELECT post_id, meta_value as acf_mc_event_date
                      FROM $wpdb->postmeta
                      WHERE meta_key = 'acf_mc_event_date'
                    ) AS meta
                    ON $wpdb->posts.ID = meta.post_id ";
    }
    return ($wp_join);
  }

  function set_default_sort($orderby, &$query) {
    global $wpdb;
    if(get_query_var('post_type') == 'mc_event') {
      return "meta.acf_mc_event_date ASC";
    }
    return $orderby;
  }
}
new mc_event();

/**
 * Add advanced custom fields.
 */
if(function_exists('register_field_group')) {
  register_field_group([
    'id' => 'acf_mc_event',
    'title' => 'Event',
    'fields' => [
      [
        'key' => 'acf_mc_event_format',
        'label' => 'Format',
        'name' => 'acf_mc_event_format',
        'type' => 'select',
        'choices' => [
          'one-column' => 'one column',
          'two-column' => 'two column',
        ],
        'default_value' => '',
        'allow_null' => 0,
        'multiple' => 0,
      ],
      [
        'key' => 'acf_mc_event_date',
        'label' => 'Date',
        'name' => 'acf_mc_event_date',
        'type' => 'date_picker',
        'date_format' => 'yymmdd',
        'display_format' => 'dd. MM yy',
        'first_day' => 1,
      ],
      [
        'key' => 'acf_mc_event_location_name',
        'label' => 'Location Name',
        'name' => 'acf_mc_event_location_name',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ],
      [
        'key' => 'acf_mc_event_location_address',
        'label' => 'Location Address',
        'name' => 'acf_mc_event_location_address',
        'type' => 'google_map',
        'center_lat' => '47.166947',
        'center_lng' => '8.516747',
        'zoom' => '',
        'height' => '',
      ],
      [
        'key' => 'acf_mc_event_time',
        'label' => 'Time',
        'name' => 'acf_mc_event_time',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => 'hh.mm',
        'formatting' => 'html',
        'maxlength' => 5,
      ],
      [
        'key' => 'acf_mc_event_web',
        'label' => 'Web',
        'name' => 'acf_mc_event_web',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => 'URL',
        'formatting' => 'none',
        'maxlength' => '',
      ],
      [
        'key' => 'acf_mc_event_tickets',
        'label' => 'Tickets',
        'name' => 'acf_mc_event_tickets',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => 'URL',
        'formatting' => 'none',
        'maxlength' => '',
      ],
    ],
    'location' => [
      [
        [
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'mc_event',
          'order_no' => 0,
          'group_no' => 0,
        ],
      ],
    ],
    'options' => [
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => [],
    ],
    'menu_order' => 0,
  ]);
}
