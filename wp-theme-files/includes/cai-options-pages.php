<?php
namespace CAI\options_pages;

if(!defined('ABSPATH')){ exit; }

function create_options_pages(){
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

function create_social_media_field(){
	if(!function_exists('acf_add_local_field_group')){
		return;
	}

	acf_add_local_field_group(array(
    'key' => 'group_65fc4a216045b',
    'title' => esc_html__('Social Media', 'cai'),
    'fields' => array(
      array(
        'key' => 'field_65fc4a22045f3',
        'label' => esc_html__('Social Links', 'cai'),
        'name' => 'social_links',
        'aria-label' => '',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'layout' => 'table',
        'pagination' => 0,
        'min' => 0,
        'max' => 0,
        'collapsed' => 'field_65fc4a32045f4',
        'button_label' => esc_html__('Add Social Link', 'cai'),
        'rows_per_page' => 20,
        'sub_fields' => array(
          array(
            'key' => 'field_65fc4a32045f4',
            'label' => esc_html__('Platform', 'cai'),
            'name' => 'platform',
            'aria-label' => '',
            'type' => 'select',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '25',
              'class' => '',
              'id' => '',
            ),
            'choices' => array(
              'facebook' => esc_html__('Facebook', 'cai'),
              'twitter' => esc_html__('X (Twitter)', 'cai'),
              'linkedin' => esc_html__('LinkedIn', 'cai'),
              'instagram' => esc_html__('Instagram', 'cai'),
              'reddit' => esc_html__('Reddit', 'cai'),
              'tiktok' => esc_html__('TikTok', 'cai'),
              'youtube' => esc_html__('YouTube', 'cai'),
              'pinterest' => esc_html__('Pinterest', 'cai'),
              'discord' => esc_html__('Discord', 'cai'),
              'telegram' => esc_html__('Telegram', 'cai'),
              'google' => esc_html__('Google', 'cai'),
            ),
            'default_value' => false,
            'return_format' => 'array',
            'multiple' => 0,
            'allow_null' => 0,
            'ui' => 0,
            'ajax' => 0,
            'placeholder' => '',
            'parent_repeater' => 'field_65fc4a22045f3',
          ),
          array(
            'key' => 'field_65fc4adf045f5',
            'label' => esc_html__('Platform Link', 'cai'),
            'name' => 'platform_link',
            'aria-label' => '',
            'type' => 'url',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '75',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'parent_repeater' => 'field_65fc4a22045f3',
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'acf-options-company-information',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
} 