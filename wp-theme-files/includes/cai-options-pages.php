<?php
if(!defined('ABSPATH')){ exit; }

function cai_acf_options_pages(){
  if(function_exists('acf_add_options_page')){
    acf_add_options_page(array(
      'page_title' => esc_html__('CAI Settings', 'cai'),
      'menu_title' => esc_html__('CAI Settings', 'cai'),
      'menu_slug' => 'cai-settings',
      'parent_slug' => '',
      'capability' => 'customize'
    ));

    acf_add_options_sub_page(array(
      'page_title' => esc_html__('Company Information', 'cai'),
      'menu_title' => esc_html__('Company Information', 'cai'),
      'parent_slug' => 'cai-settings'
    ));

    acf_add_options_sub_page(array(
      'page_title' => esc_html__('Site Defaults', 'cai'),
      'menu_title' => esc_html__('Site Defaults', 'cai'),
      'parent_slug' => 'cai-settings'
    ));
  }
}