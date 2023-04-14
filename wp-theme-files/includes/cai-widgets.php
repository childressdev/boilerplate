<?php
namespace CAI\widgets;

if(!defined('ABSPATH')){ exit; }

function register_widgets(){
  register_sidebar(
    array(
      'name' => esc_html__('Footer Widget 1', 'cai'),
      'id' => 'sidebar-1',
      'description' => esc_html__('Add widgets here to appear in column 1 of the footer', 'cai'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4>',
      'after_title' => '</h4>'
    )
  );
}