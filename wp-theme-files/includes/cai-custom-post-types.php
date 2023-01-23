<?php
if(!defined('ABSPATH')){ exit; }

function cai_register_post_type($post_type = '', $plural = '', $single = '', $menu_icon = 'dashicons-admin-post', $options = array()){
  if(!$post_type || !$plural || !$single){ return false; }

  $labels = array(
    'name' => $plural,
    'singular_name' => $single,
    'menu_name' => $plural,
    'add_new_item' => sprintf(esc_html__('Add New %s', 'cai'), $single),
    'new_item' => sprintf(esc_html__('New %s', 'cai'), $single),
    'edit_item' => sprintf(esc_html__('Edit %s', 'cai'), $single),
    'view_item' => sprintf(esc_html__('View %s', 'cai'), $single),
    'search_items' => sprintf(esc_html__('Search %s', 'cai'), $plural),
    'all_items' => sprintf(esc_html__('All %s', 'cai'), $plural),
    'not_found' => sprintf(esc_html__('No %s Found', 'cai'), $plural)
  );

  $args = array(
    'labels' => $labels,
    'description' => '',
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
    'show_in_rest' => true,
    'menu_position' => 6,
    'menu_icon' => $menu_icon,
    'supports' => array(
      'title',
      'editor',
      'custom-fields',
      'revisions',
      'thumbnail'
    )
  );

  $args = array_merge($args, $options);
  register_post_type($post_type, $args);
}

function cai_register_taxonomy($taxonomy = '', $plural = '', $single = '', $post_type = '', $hierarchical = true, $options = array()){
  if(!$taxonomy || !$plural || !$single){ return false; }

  $labels = array(
    'name' => $plural,
    'singular_name' => $single,
    'menu_name' => $plural,
    'all_items' => sprintf(esc_html__('All %s', 'cai'), $plural),
    'edit_item' => sprintf(esc_html__('Edit %s', 'cai'), $single),
    'view_item' => sprintf(esc_html__('View %s', 'cai'), $single),
    'update_item' => sprintf(esc_html__('Update %s', 'cai'), $single),
    'add_new_item' => sprintf(esc_html__('Add New %s', 'cai'), $single),
    'parent_item' => sprintf(esc_html__('Parent %s', 'cai'), $single),
    'search_items' => sprintf(esc_html__('Search %s', 'cai'), $plural),
    'popular_items' => sprintf(esc_html__('Popular %s', 'cai'), $plural),
    'add_or_remove_item' => sprintf(esc_html__('Add or Remove %s', 'cai'), $single),
    'not_found' => sprintf(esc_html__('No %s Found', 'cai'), $plural),
    'back_to_items' => sprintf(esc_html__('Back to %s', 'cai'), $plural)
  );

  $args = array(
    'label' => $plural,
    'labels' => $labels,
    'hierarchical' => $hierarchical,
    'public' => true,
    'show_ui' => true,
    'show_in_nav_menus' => true,
    'show_admin_column' => true,
    'show_in_quick_edit' => true,
    'show_in_rest' => true,
    'query_var' => $taxonomy,
    'rewrite' => true
  );
  
  $args = array_merge($args, $options);
  register_taxonomy($taxonomy, $post_type, $args);
}