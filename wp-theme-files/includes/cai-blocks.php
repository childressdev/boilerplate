<?php
/**
 * Blocks
 * 
 * @package Jenkins Excavating & Logging
 * @author Childress Agency, Inc
 * @since 1.0.0
 * 
 * https://www.billerickson.net/building-acf-blocks-with-block-json/
 */

namespace JEL\blocks;

/**
 * Register blocks
 */
add_filter('block_categories_all', __NAMESPACE__ . '\block_categories');
add_action('init', __NAMESPACE__ . '\load_blocks', 5);
add_filter('acf/settings/load_json', __NAMESPACE__ . '\load_acf_field_group');
add_action('init', __NAMESPACE__ . '\register_custom_block_styles');
add_action('init', __NAMESPACE__ . '\customize_core_block_styles');

/**
 * Register block style
 * adds an option to a core block that adds a class
 * that can be styled
 * https://developer.wordpress.org/news/2023/02/creating-custom-block-styles-in-wordpress-themes/
 */
function register_custom_block_styles(){
  register_block_style(
    'core/media-text',
    array(
      'name' => 'small-icon',
      'label' => esc_html__('Small Icon', 'jel')
    )
  );

  register_block_style(
    'core/heading',
    array(
      'name' => 'text-shadow',
      'label' => esc_html__('Text Shadow', 'jel')
    )
  );

  register_block_style(
    'core/paragraph',
    array(
      'name' => 'text-shadow',
      'label' => esc_html__('Text Shadow', 'jel')
    )
  );
}

/**
 * Core block style customization
 * 
 * @param array $blocks core/blockname
 * @param string $handle 
 */
function customize_core_block_styles(){
  enqueue_core_block_styles(
    array(
      'core/heading',
      'core/paragraph',
      'core/media-text',
    ),
    'jel'
  );
}


/**
 * Load Blocks
 */
function load_blocks(){
  $blocks = get_blocks();
  $blocks_folder = get_template_directory() . '/blocks/';

  foreach($blocks as $block){
    $block_folder = $blocks_folder . $block;

    if(file_exists($block_folder . '/block.json')){
      register_block_type($block_folder . '/block.json');
      
      if(file_exists($block_folder . '/style.css')){
        wp_register_style(
          'block-' . $block,
          $block_folder . '/style.css',
          null,
          THEME_VERSION
        );
      }

      if(file_exists($block_folder . '/init.php')){
        include_once $block_folder . '/init.php';
      }
    }
  }
}

/**
 * Block Categories
 */
function block_categories($categories){
  $include = true;
  foreach($categories as $category){
    if($category['slug'] === 'childressagency'){
      //category already exists
      $include = false;
    }
  }

  if($include){
    $categories = array_merge(
      $categories,
      array(
        array(
          'slug' => 'childressagency',
          'title' => esc_html('Childress Agency Blocks', 'cai'),
        )
      )
    );
  }

  return $categories;
}

/**
 * Load ACF field groups for blocks
 */
add_filter('acf/settings/load_json', __NAMESPACE__ . '\load_acf_field_group');
function load_acf_field_group($paths){
  $blocks = get_blocks();

  foreach($blocks as $block){
    $paths[] = get_template_directory() . '/blocks/' . $block;
  }

  return $paths;
}

/**
 * Get Blocks
 * Scan block directory and make an array of all blocks.  Store this as
 * an option to cache it.  Don't forget to change theme version in style.css
 * to bust the cache when blocks are added/removed.
 */
function get_blocks(){
  $blocks = get_option('cai_blocks');
  $version = get_option('cai_blocks_version');
  if(empty($blocks) 
      || version_compare(THEME_VERSION, $version) 
      || (function_exists('wp_get_environment_type') && wp_get_environment_type() !== 'production')){
    $blocks = scandir(get_template_directory() . '/blocks/');
    $blocks = array_values(array_diff($blocks, array('..', '.', '.DS_Store', '_base-block')));

    update_option('cai_blocks', $blocks);
    update_option('cai_blocks_version', THEME_VERSION);
  }

  return $blocks;
}

function enqueue_core_block_styles($blocks, $handle){
  foreach($blocks as $block){
    $slug = str_replace('/', '-', $block);

    wp_enqueue_block_style(
      $block,
      array(
        'handle' => $handle . '-block-' . $slug,
        'src' => get_theme_file_uri('blocks/' . $slug . '.css'),
        'path' => get_theme_file_path('blocks/' . $slug . '.css')
      )
    );
  }
}