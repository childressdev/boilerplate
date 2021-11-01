<?php
if(WP_DEBUG === true){
  add_action('wp_footer', 'show_template');
}
function show_template() {
	global $template;
	print_r($template);
}

//hide acf Custom Fields menu item (uncomment next line)
//add_filter('acf/settings/show_admin', '__return_false');

/**
 * Use cdn jquery instead of WordPress'
 */
add_action('wp_enqueue_scripts', 'jquery_cdn');
function jquery_cdn(){
  if(!is_admin()){
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', false, null, true);
    wp_enqueue_script('jquery');
  }
}

/**
 * Enqueue scripts
 */
add_action('wp_enqueue_scripts', 'cai_scripts');
function cai_scripts(){
  wp_register_script(
    'bootstrap-scripts',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',
    array('jquery'),
    '',
    true
  );

  wp_register_script(
    'cai-scripts',
    get_stylesheet_directory_uri() . '/js/custom-scripts.min.js',
    array('jquery', 'bootstrap-scripts'),
    '',
    true
  );

  wp_enqueue_script('bootstrap-scripts');
  wp_enqueue_script('cai-scripts');
}

/**
 * Add integrity check to cdn scripts
 */
add_filter('script_loader_tag', 'cai_add_script_meta', 10, 2);
function cai_add_script_meta($tag, $handle){
  switch($handle){
    case 'jquery':
      $tag = str_replace('></script>', ' integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>', $tag);
      break;

    case 'bootstrap-scripts':
      $tag = str_replace('></script>', ' integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>', $tag);
      break;
  }

  return $tag;
}

/**
 * Enqueue styles
 */
add_action('wp_enqueue_scripts', 'cai_styles');
function cai_styles(){
  wp_register_style(
    'google-fonts',
    'https://fonts.googleapis.com/css?family=Maitree:400,700|Nunito+Sans:400,600,700|Nunito:700'
  );

  wp_register_style(
    'cai-css',
    get_stylesheet_directory_uri() . '/style.css'
  );

  wp_enqueue_style('google-fonts');
  wp_enqueue_style('cai-css');
}

/**
 * Enqueue block editor styles
 */
add_action('enqueue_block_editor_assets', 'cai_admin_styles');
function cai_admin_styles(){
  wp_enqueue_style(
    'editor-style',
    get_stylesheet_directory_uri() . '/editor.css'
  );
}

/**
 * Setup theme options and support
 */
add_action('after_setup_theme', 'cai_setup');
function cai_setup(){
  add_theme_support('post-thumbnails');

  add_theme_support(
    'html5',
    array(
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
      'navigation-widgets'
    )
  );

  add_theme_support('editor-styles');
  add_theme_support('wp-block-styles');
  add_theme_support('responsive-embeds');
  add_theme_support('align-wide');
  add_theme_support('custom-line-height');

  /**
   * Define editor font sizes
   */
  add_theme_support(
    'editor-font-sizes',
    array(
      array(
        'name' => esc_html__('Extra small', 'cai'),
        'shortName' => esc_html_x('XS', 'Font size', 'cai'),
        'size' => 14,
        'slug' => 'extra-small'
      ),
      array(
        'name' => esc_html__('Small', 'cai'),
        'shortName' => esc_html_x('S', 'Font size', 'cai'),
        'size' => 16,
        'slug' => 'small'
      ),
      array(
        'name' => esc_html__('Normal', 'cai'),
        'shortName' => esc_html_x('N', 'Font size', 'cai'),
        'size' => 18,
        'slug' => 'normal'
      ),
      array(
        'name' => esc_html__('Medium', 'cai'),
        'shortName' => esc_html_x('M', 'Font size', 'cai'),
        'size' => 24,
        'slug' => 'medium'
      ),
      array(
        'name' => esc_html__('Large', 'cai'),
        'shortName' => esc_html_x('L', 'Font size', 'cai'),
        'size' => 32,
        'slug' => 'large'
      ),
      array(
        'name' => esc_html__('Extra Large', 'cai'),
        'shortName' => esc_html_x('XL', 'Font size', 'cai'),
        'size' => 56,
        'slug' => 'extra-large'
      ),
      array(
        'name' => esc_html__('Huge', 'cai'),
        'shortName' => esc_html_x('XXL', 'Font size', 'cai'),
        'size' => 65,
        'slug' => 'huge'
      )
    )
  );

  /**
   * Define custom color palette
   */
  $color_main = '#1097CD';
  $color_alt_1 = '#262262';
  $color_alt_2 = '#080714';
  $color_alt_3 = '#FCB31F';
  $color_alt_4 = '#f5f5f5';
  $black = '#000000';
  $white = '#ffffff';

  add_theme_support(
    'editor-color-palette',
    array(
      array(
        'name' => esc_html__('Color Main', 'cai'),
        'slug' => 'color-main',
        'color' => $color_main
      ),
      array(
        'name' => esc_html__('Color Alt 1', 'cai'),
        'slug' => 'color-alt-1',
        'color' => $color_alt_1
      ),
      array(
        'name' => esc_html__('Color Alt 2', 'cai'),
        'slug' => 'color-alt-2',
        'color' => $color_alt_2
      ),
      array(
        'name' => esc_html__('Color Alt 3', 'cai'),
        'slug' => 'color-alt-3',
        'color' => $color_alt_3
      ),
      array(
        'name' => esc_html__('Color Alt 4', 'cai'),
        'slug' => 'color-alt-4',
        'color' => $color_alt_4
      ),
      array(
        'name' => esc_html__('Black', 'cai'),
        'slug' => 'black',
        'color' => $black
      ),
      array(
        'name' => esc_html__('White', 'cai'),
        'slug' => 'white',
        'color' => $white
      )
    )
  );  

  /**
   * Define custom gradient presets
   */
  add_theme_support(
    'editor-gradient-presets',
    array(
      array(
        'name' => esc_html__('Color Main to Color Alt 1', 'cai'),
        'slug' => 'light-blue-to-dark-violet',
        'gradient' => 'linear-gradient(to right, ' . $color_main . ' 0%, ' . $color_alt_1 . ' 100%)'
      )
    )
  );

  /**
   * Register Navs
   */
  register_nav_menus(array(
    'header-nav' => 'Header Navigation',
    'footer-nav' => 'Footer Navigation',
  ));

  load_theme_textdomain('cai', get_stylesheet_directory_uri() . '/languages');
}

/**
 * required files
 */
require_once dirname(__FILE__) . '/includes/class-wp-bootstrap-navwalker.php';

/**
 * Register Widgets
 */
add_action('widgets_init', 'cai_widgets_init');
function cai_widgets_init(){
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

/**
 * Add reusable blocks menu item
 */
add_action('admin_menu', 'cai_reusable_blocks_admin_menu');
function cai_reusable_blocks_admin_menu(){
  add_menu_page(
    esc_html__('Reusable Blocks', 'cai'),
    esc_html__('Reusable Blocks', 'cai'),
    'edit_posts',
    'edit.php?post_type=wp_block',
    '',
    'dashicons-editor-table',
    22
  );
}

/**
 * Create custom block category
 */
add_filter('block_categories_all', 'cai_custom_block_categories', 10, 2);
function cai_custom_block_categories($categories, $post){
  return array_merge(
    $categories,
    array(
      array(
        'title' => esc_html__('cai Custom Blocks', 'cai'),
        'slug' => 'cai-custom-blocks',
        'icon' => get_stylesheet_directory_uri() . '/images/icon-cai.png'
      )
    )
  );
}

/**
 * Register custom blocks
 */
add_action('acf/init', 'cai_register_blocks');
function cai_register_blocks(){
  if(function_exists('acf_register_block_type')){
    acf_register_block_type(array(
      'name' => 'prestyled-button',
      'title' => esc_html__('Pre-Styled Button', 'cai'),
      'description' => esc_html__('Add a pre-styled button'),
      'category' => 'cai-custom-blocks',
      'icon' => 'button',
      'align' => 'full',
      'render_template' => get_stylesheet_directory() . '/partials/blocks/prestyled-button.php'
    ));
  }
}

/**
 * Create acf options pages
 */
add_action('acf/init', 'cai_acf_options_pages');
function cai_acf_options_pages(){
  if(function_exists('acf_add_options_page')){
    acf_add_options_page(array(
      'page_title' => 'Tysons Chamber Settings',
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