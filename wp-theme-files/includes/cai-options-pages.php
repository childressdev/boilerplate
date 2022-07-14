<?php
if(!defined('ABSPATH')){ exit; }

function cai_acf_options_pages(){
  if(function_exists('acf_add_options_page')){
    acf_add_options_page(array(
      'page_title' => 'CAI Settings',
      'menu_title' => 'cai Settings',
      'menu_slug' => 'cai-settings',
      'parent_slug' => '',
      'capability' => 'customize'
    ));

    acf_add_options_sub_page(array(
      'page_title' => 'Company Information',
      'menu_title' => 'Company Information',
      'parent_slug' => 'cai-settings'
    ));

    acf_add_options_sub_page(array(
      'page_title' => 'Site Defaults',
      'menu_title' => 'Site Defaults',
      'parent_slug' => 'cai-settings'
    ));
  }
}