<?php
namespace FXBGVIOLINS\options_pages;

if(!defined('ABSPATH')){ exit; }

function create_options_pages(){
  if(function_exists('acf_add_options_page')){
    acf_add_options_page(array(
      'page_title' => esc_html__('FXBG Violins Settings', 'fxbgviolins'),
      'menu_title' => esc_html__('FXBG Violins Settings', 'fxbgviolins'),
      'menu_slug' => 'fxbgviolins-settings',
      'parent_slug' => '',
      'capability' => 'customize'
    ));

    acf_add_options_sub_page(array(
      'page_title' => esc_html__('Company Information', 'fxbgviolins'),
      'menu_title' => esc_html__('Company Information', 'fxbgviolins'),
      'parent_slug' => 'fxbgviolins-settings'
    ));

    acf_add_options_sub_page(array(
      'page_title' => esc_html__('Site Defaults', 'fxbgviolins'),
      'menu_title' => esc_html__('Site Defaults', 'fxbgviolins'),
      'parent_slug' => 'fxbgviolins-settings'
    ));
  }
}

function create_social_media_field(){
	if(!function_exists('acf_add_local_field_group')){
		return;
	}

	acf_add_local_field_group(array(
    'key' => 'group_65fc4a216045b',
    'title' => esc_html__('Social Media', 'fxbgviolins'),
    'fields' => array(
      array(
        'key' => 'field_65fc4a22045f3',
        'label' => esc_html__('Social Links', 'fxbgviolins'),
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
        'button_label' => esc_html__('Add Social Link', 'fxbgviolins'),
        'rows_per_page' => 20,
        'sub_fields' => array(
          array(
            'key' => 'field_65fc4a32045f4',
            'label' => esc_html__('Platform', 'fxbgviolins'),
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
              'facebook' => esc_html__('Facebook', 'fxbgviolins'),
              'twitter' => esc_html__('X (Twitter)', 'fxbgviolins'),
              'linkedin' => esc_html__('LinkedIn', 'fxbgviolins'),
              'instagram' => esc_html__('Instagram', 'fxbgviolins'),
              'reddit' => esc_html__('Reddit', 'fxbgviolins'),
              'tiktok' => esc_html__('TikTok', 'fxbgviolins'),
              'youtube' => esc_html__('YouTube', 'fxbgviolins'),
              'pinterest' => esc_html__('Pinterest', 'fxbgviolins'),
              'discord' => esc_html__('Discord', 'fxbgviolins'),
              'telegram' => esc_html__('Telegram', 'fxbgviolins'),
              'google' => esc_html__('Google', 'fxbgviolins'),
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
            'label' => esc_html__('Platform Link', 'fxbgviolins'),
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