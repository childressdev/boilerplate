<?php
if(!defined('ABSPATH')){ exit; }
if(!defined('WP_DEBUG')){ define('WP_DEBUG', true); }

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
 * customize the color palette
 */
function cai_color_palette(){
  $color_palette = array(
    'color_main'  => '#A28C0B',
    'color_alt_1' => '#223D62',
    'color_alt_2' => '#f2f2f2',
    'color_alt_3' => '#9D9D9D',
    'color_alt_4' => '#707070',
    'black'       => '#000000',
    'white'       => '#ffffff'
  );

  return $color_palette;
}

/**
 * customize the font sizes
 */
function cai_font_sizes(){
  $font_sizes = array(
    'XS'  => 16,
    'S'   => 18,
    'N'   => 20,
    'M'   => 28,
    'L'   => 40,
    'XL'  => 54,
    'XXL' => 60
  );

  return $font_sizes;
}

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
    'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
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
      $tag = str_replace('></script>', ' integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>', $tag);
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
    'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700;800&display=swap'
  );

  wp_register_style(
    'cai-css',
    get_stylesheet_directory_uri() . '/style.css'
  );

  wp_enqueue_style('google-fonts');
  wp_enqueue_style('cai-css');
}

/**
 * Setup theme options and support
 */
add_action('after_setup_theme', 'cai_setup');
function cai_setup(){
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

  add_editor_style('editor.css');

  /**
   * Define editor font sizes for blocks
   */
  $font_sizes = cai_font_sizes();
  add_theme_support(
    'editor-font-sizes',
    array(
      array(
        'name' => esc_html__('Extra small', 'cai'),
        'shortName' => esc_html_x('XS', 'Font size', 'cai'),
        'size' => $font_sizes['XS'],
        'slug' => 'extra-small'
      ),
      array(
        'name' => esc_html__('Small', 'cai'),
        'shortName' => esc_html_x('S', 'Font size', 'cai'),
        'size' => $font_sizes['S'],
        'slug' => 'small'
      ),
      array(
        'name' => esc_html__('Normal', 'cai'),
        'shortName' => esc_html_x('N', 'Font size', 'cai'),
        'size' => $font_sizes['N'],
        'slug' => 'normal'
      ),
      array(
        'name' => esc_html__('Medium', 'cai'),
        'shortName' => esc_html_x('M', 'Font size', 'cai'),
        'size' => $font_sizes['M'],
        'slug' => 'medium'
      ),
      array(
        'name' => esc_html__('Large', 'cai'),
        'shortName' => esc_html_x('L', 'Font size', 'cai'),
        'size' => $font_sizes['L'],
        'slug' => 'large'
      ),
      array(
        'name' => esc_html__('Extra Large', 'cai'),
        'shortName' => esc_html_x('XL', 'Font size', 'cai'),
        'size' => $font_sizes['XL'],
        'slug' => 'extra-large'
      ),
      array(
        'name' => esc_html__('Huge', 'cai'),
        'shortName' => esc_html_x('XXL', 'Font size', 'cai'),
        'size' => $font_sizes['XXL'],
        'slug' => 'huge'
      )
    )
  );

  /**
   * Define custom color palette for blocks
   */
  $color_palette = cai_color_palette();

  add_theme_support(
    'editor-color-palette',
    array(
      array(
        'name' => esc_html__('Color Main', 'cai'),
        'slug' => 'color-main',
        'color' => $color_palette['color_main']
      ),
      array(
        'name' => esc_html__('Color Alt 1', 'cai'),
        'slug' => 'color-alt-1',
        'color' => $color_palette['color_alt_1']
      ),
      array(
        'name' => esc_html__('Color Alt 2', 'cai'),
        'slug' => 'color-alt-2',
        'color' => $color_palette['color_alt_2']
      ),
      array(
        'name' => esc_html__('Color Alt 3', 'cai'),
        'slug' => 'color-alt-3',
        'color' => $color_palette['color_alt_3']
      ),
      array(
        'name' => esc_html__('Color Alt 4', 'cai'),
        'slug' => 'color-alt-4',
        'color' => $color_palette['color_alt_4']
      ),
      array(
        'name' => esc_html__('Black', 'cai'),
        'slug' => 'black',
        'color' => $color_palette['black']
      ),
      array(
        'name' => esc_html__('White', 'cai'),
        'slug' => 'white',
        'color' => $color_palette['white']
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
        'gradient' => 'linear-gradient(to right, ' . $color_palette['color_main'] . ' 0%, ' . $color_palette['color_alt_1'] . ' 100%)'
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
add_action('init', 'cai_register_post_types');
function cai_register_post_types(){
  cai_register_post_type(
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
add_action('init', 'cai_register_taxonomies');
function cai_register_taxonomies(){
  cai_register_taxonomy(
    'service_category',
    esc_html__('Service Categories', 'cai'),
    esc_html__('Service Category', 'cai'),
    'service'
  );
}

/**
 * Register custom blocks
 */
add_action('acf/init', 'cai_register_blocks');

/**
 * Create acf options pages
 */
add_action('acf/init', 'cai_acf_options_pages');

/**
 * Register Widgets
 */
add_action('widgets_init', 'cai_widgets_init');

/**
 * Register Shortcodes
 */
add_action('init', 'cai_register_shortcode');

/**
 * Custom login logo
 */
add_action('login_enqueue_scripts', 'cai_login_logo');
function cai_login_logo(){
  $image_width = '525';
  $image_height = '110';
  $image_url = get_stylesheet_directory_uri() . '/images/logo.png'; ?>

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
add_filter('login_headerurl', 'cai_login_headerurl');
function cai_login_headerurl($url){
  return home_url();
}

/**
 * Custom color pallette for acf color picker field
 */
add_action('acf/input/admin_footer', 'cai_acf_color_palette');
function cai_acf_color_palette(){
  $color_palette = cai_color_palette();
  $acf_palette = array();
  foreach($color_palette as $key => $value){
    $acf_palette[] = $value;
  } ?>

  <script>
    (function($){
      acf.add_filter('color_picker_args', function(args, field){
        args.palettes = <?php echo wp_json_encode($acf_palette); ?>

        return args;
      });
    })(jQuery);
  </script>
<?php }