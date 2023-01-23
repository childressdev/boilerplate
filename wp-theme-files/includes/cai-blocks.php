<?php
if(!defined('ABSPATH')){ exit; }

function cai_register_blocks(){
  if(function_exists('acf_register_block_type')){
    acf_register_block_type(array(
      'name' => 'prestyled-button',
      'title' => esc_html__('Pre-Styled Button', 'cai'),
      'description' => esc_html__('Add a pre-styled button', 'cai'),
      'category' => 'cai-custom-blocks',
      'icon' => 'button',
      'align' => 'full',
      'render_template' => get_stylesheet_directory() . '/partials/blocks/prestyled-button.php'
    ));
  }
}