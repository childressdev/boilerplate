<?php
if(!defined('ABSPATH')){ exit; }

function cai_create_post_types(){
  $cpt_video_args = array(
    'capability_type' => 'post',
    'public' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'menu_position' => 6,
    'menu_icon' => 'dashicons-video-alt',
    'query_var' => 'video',
    'has_archive' => false,
    'show_in_rest' => true,
    'supports' => array(
      'title',
      //'editor',
      'custom-fields',
      'revisions',
      'thumbnail'
    ),
    'labels' => array(
      'name' => esc_html_x('Videos', 'post type name', 'cai'),
      'singular_name' => esc_html_x('Video', 'post type singular name', 'cai'),
      'menu_name' => esc_html_x('Videos', 'post type menu name', 'cai'),
      'add_new_item' => esc_html__('Add New Video', 'cai'),
      'search_items' => esc_html__('Search Videos', 'cai'),
      'edit_item' => esc_html__('Edit Video', 'cai'),
      'view_item' => esc_html__('View Video', 'cai'),
      'all_items' => esc_html__('All Videos', 'cai'),
      'not_found' => esc_html__('No Videos Found', 'cai')
    )
  );
  register_post_type('video', $cpt_video_args);

  $tax_video_cat_args = array(
    'hierarchical' => true,
    'show_admin_column' => true,
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => esc_html_x('Video Categories', 'taxonomy name', 'cai'),
      'singular_name' => esc_html_x('Video Category', 'taxonomy singular name', 'cai'),
      'all_items' => esc_html__('All Video Categories', 'cai'),
      'edit_item' => esc_html__('Edit Video Category', 'cai'),
      'view_item' => esc_html__('View Video Category', 'cai'),
      'update_item' => esc_html__('Update Video Category', 'cai'),
      'add_new_item' => esc_html__('Add New Video Category', 'cai'),
      'parent_item' => esc_html__('Parent Video Category', 'cai'),
      'search_items' => esc_html__('Search Video Categories', 'cai'),
      'popular_items' => esc_html__('Popular Video Categories', 'cai'),
      'add_or_remove_item' => esc_html__('Add or Remove Video Category', 'cai'),
      'not_found' => esc_html__('No Video Categories Found', 'cai'),
      'back_to_items' => esc_html__('Back to Video Categories', 'cai')
    )
  );
  register_taxonomy('video_category', 'video', $tax_video_cat_args);

  $tax_video_tag_args = array(
    'hierarchical' => false,
    'show_admin_column' => true,
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => esc_html_x('Video Tags', 'taxonomy name', 'cai'),
      'singular_name' => esc_html_x('Video Tag', 'taxonomy singular name', 'cai'),
      'all_items' => esc_html__('All Video Tags', 'cai'),
      'edit_item' => esc_html__('Edit Video Tags', 'cai'),
      'view_item' => esc_html__('View Video Tags', 'cai'),
      'update_item' => esc_html__('Update Video Tags', 'cai'),
      'add_new_item' => esc_html__('Add New Video Tag', 'cai'),
      'search_items' => esc_html__('Search Video Tags', 'cai'),
      'popular_items' => esc_html__('Popular Video Tags', 'cai'),
      'add_or_remove_item' => esc_html__('Add or Remove Video Tag', 'cai'),
      'not_found' => esc_html__('No Video Tags Found', 'cai'),
      'back_to_items' => esc_html__('Back to Video Tags', 'cai')
    )
  );
  register_taxonomy('video_tag', 'video', $tax_video_tag_args);
}