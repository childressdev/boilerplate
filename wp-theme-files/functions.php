<?php
namespace CAI;

if(!defined('ABSPATH')){ exit; }

switch(wp_get_environment_type()){
  case 'local':
  case 'development':
  case 'staging':
    if(current_user_can('manage_options')){
      add_action('wp_footer', __NAMESPACE__ . '\show_template');
    }
  break;

  case 'production':
  default:
    //hide acf Custom Fields menu item
    add_filter('acf/settings/show_admin', '__return_false');
}

function show_template() {
	global $template;
  printf('<p style="font-size:12px;">%s</p>', $template);
}

/**
 * cache busting
 * Get theme version from style.css comments
 * 
 */
$theme = wp_get_theme();
define('CAI_THEME_VERSION', $theme->get('Version'));

/**
 * Use cdn jquery instead of WordPress'
 */
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\jquery_cdn');
function jquery_cdn(){
  if(!is_admin()){
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', false, null, true);
    wp_enqueue_script('jquery');
  }
}

/**
 * Enqueue scripts
 */
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_scripts');
function enqueue_scripts(){
  $handle = __NAMESPACE__ . '-scripts';

  wp_register_script(
    'bootstrap-scripts',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js',
    array('jquery'),
    '5.3.5',
    true
  );

  wp_enqueue_script('bootstrap-scripts');
}

/**
 * Enqueue block editor scripts
 */
add_action('enqueue_block_editor_assets', __NAMESPACE__ . '\enqueue_block_editor_scripts');
function enqueue_block_editor_scripts(){
  $handle = __NAMESPACE__ . '-editor-scripts';

  wp_register_script(
    'bootstrap-scripts',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js',
    array('jquery'),
    '5.3.5',
    true
  );

  wp_enqueue_script('bootstrap-scripts');
}

/**
 * Add integrity check to cdn scripts
 */
add_filter('script_loader_tag', __NAMESPACE__ . '\add_script_meta', 10, 2);
function add_script_meta($tag, $handle){
  switch($handle){
    case 'jquery':
      $tag = str_replace('></script>', ' integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>', $tag);
      break;

    case 'bootstrap-scripts':
      $tag = str_replace('></script>', ' integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>', $tag);
      break;
  }

  return $tag;
}

/**
 * Enqueue styles
 * 
 * Order is set 8 so BootStrap loads before WordPress
 */
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_styles', 8);
function enqueue_styles(){
  $handle = __NAMESPACE__ . '-css';

  wp_register_style(
    'bootstrap-styles',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css',
    array(),
    CAI_THEME_VERSION
  );

  wp_register_style(
    $handle . '-variables',
    get_stylesheet_directory_uri() . '/assets/css/variables.css',
    array(),
    CAI_THEME_VERSION
  );

  wp_register_style(
    $handle . '-main',
    get_stylesheet_directory_uri() . '/assets/css/main.css',
    array($handle . 'variables'),
    CAI_THEME_VERSION
  );

  wp_register_style(
    $handle . '-frontend-only',
    get_stylesheet_directory_uri() . '/assets/css/frontend-only.css',
    array($handle . 'main', $handle . 'variables'),
    CAI_THEME_VERSION
  );

  wp_register_style(
    $handle . '-header',
    get_stylesheet_directory_uri() . '/assets/css/header.css',
    array($handle . 'main', $handle . 'variables'),
    CAI_THEME_VERSION
  );

  wp_register_style(
    $handle . '-footer',
    get_stylesheet_directory_uri() . '/assets/css/footer.css',
    array($handle . 'main', $handle . 'variables'),
    CAI_THEME_VERSION
  );

  wp_register_style(
    $handle,
    get_stylesheet_directory_uri() . '/style.css',
    array('bootstrap-styles'),
    CAI_THEME_VERSION
  );

  wp_enqueue_style('bootstrap-styles');
  wp_enqueue_style($handle . '-variables');
  wp_enqueue_style($handle . '-main');
  wp_enqueue_style($handle . '-frontend-only');
  wp_enqueue_style($handle . '-header');
  wp_enqueue_style($handle . '-footer');
  wp_enqueue_style($handle);
}

/**
 * Add integrity check to cdn styles
 */
add_filter('style_loader_tag', __NAMESPACE__ . '\add_style_meta', 10, 2);
function add_style_meta($tag, $handle){
  switch($handle){
    case 'bootstrap-styles':
      $tag = str_replace('></link>', ' integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous"></link>', $tag);
      break;
  }

  return $tag;
}

/**
 * Setup theme options and support
 */
add_action('after_setup_theme', __NAMESPACE__ . '\theme_setup');
function theme_setup(){
  add_theme_support('post-thumbnails');
  //add_image_size( string $name, int $width, int $height, bool|array $crop = false )

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
  add_theme_support('custom-spacing');

  add_editor_style(
    array(
      get_stylesheet_directory_uri() . '/assets/css/variables.css',
      get_stylesheet_directory_uri() . '/assets/css/main.css',
      get_stylesheet_directory_uri() . '/assets/css/editor.css',
      urlencode('https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css')
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
require_once dirname(__FILE__) . '/includes/cai-fallback-menus.php';
require_once dirname(__FILE__) . '/includes/cai-custom-post-types.php';
require_once dirname(__FILE__) . '/includes/cai-blocks.php';
require_once dirname(__FILE__) . '/includes/cai-options-pages.php';
require_once dirname(__FILE__) . '/includes/cai-widgets.php';
require_once dirname(__FILE__) . '/includes/cai-register-shortcodes.php';

/**
 * Register Custom Post Types
 * 
 * @param string $post_type Post Type
 * @param string $plural Plural Label
 * @param string $single Single Label
 * @param string $menu_icon Default is dashicons-admin-post
 * @param array $options Post Type Arguments
 */
add_action('init', __NAMESPACE__ . '\register_post_types');
function register_post_types(){
  cpts\create_post_type(
    'service',
    esc_html__('Services', 'cai'),
    esc_html__('Service', 'cai'),
    'dashicons-hammer'
  );
}

/**
 * Register Taxonomies
 * 
 * @param string $taxonomy Taxonomy
 * @param string $plural Plural Label
 * @param string $single Single Label
 * @param string $post_type Post Type for Taxonomy
 * @param boolean $hierarchical Default is true
 * @param array $options Taxonomy arguments
 */
add_action('init', __NAMESPACE__ . '\register_taxonomies');
function register_taxonomies(){
  cpts\create_taxonomy(
    'service_category',
    esc_html__('Service Categories', 'cai'),
    esc_html__('Service Category', 'cai'),
    'service'
  );
}

/**
 * Create acf options pages
 */
add_action('acf/init', __NAMESPACE__ . '\options_pages\create_options_pages');

/**
 * Create acf social media field
 */
add_action('acf/include_fields', __NAMESPACE__ . '\options_pages\create_social_media_field');

/**
 * Register Widgets
 */
//add_action('widgets_init', __NAMESPACE__ . '\widgets\register_widgets');

/**
 * Register Shortcodes
 */
//add_action('init', __NAMESPACE__ . '\shortcodes\register_shortcode');

/**
 * Add reusable blocks menu item
 */
add_action('admin_menu', __NAMESPACE__ . '\reusable_blocks_admin_menu');
function reusable_blocks_admin_menu(){
  add_menu_page(
    esc_html__('Theme Patterns', 'cai'),
    esc_html__('Theme Patterns', 'cai'),
    'edit_posts',
    'edit.php?post_type=wp_block',
    '',
    'dashicons-editor-table',
    22
  );
}

/**
 * Custom login logo
 */
add_action('login_enqueue_scripts', __NAMESPACE__ . '\login_logo');
function login_logo(){
  $image_width = '525';
  $image_height = '110';
  $image_url = get_stylesheet_directory_uri() . '/assets/images/logo.png'; ?>

  <style>
	  #login{
      width: auto !important;
		  max-width: <?php echo ((int)$image_width > 320) ? $image_width : '320'; ?>px !important;
	  }
    #login h1 a, 
    .login h1 a{
      background-image: url(<?php echo $image_url; ?>);
      height: <?php echo $image_height; ?>px;
      width: <?php echo $image_width; ?>px;
      background-size: contain;
      background-repeat: no-repeat;
      padding-bottom: 30px;
    }
  </style>
<?php }

/**
 * Custom login logo link
 */
add_filter('login_headerurl', __NAMESPACE__ . '\login_headerurl');
function login_headerurl($url){
  return home_url();
}

/**
 * Show svg sprite in editor
 */
add_action('admin_footer', __NAMESPACE__ . '\add_svg_sprite_to_editor');
function add_svg_sprite_to_editor(){
  get_template_part('partials/sprites.svg');
}

add_filter( 'wp_bootstrap_blocks_container_default_attributes', __NAMESPACE__ . '\container_default_attributes', 10, 1 );
function container_default_attributes( $default_attributes ) {
    $default_attributes['isFluid'] = true;
    $default_attributes['marginAfter'] = 'mb-0';

    return $default_attributes;
}

/**
 * Don't show default WP block patterns
 */
add_filter('should_load_remote_block_patterns', '__return_false');