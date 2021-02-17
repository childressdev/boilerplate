<?php
if(WP_DEBUG === true){
  add_action('wp_footer', 'show_template');
}
function show_template() {
	global $template;
	print_r($template);
}

//hide acf settings (uncomment next line)
//add_filter('acf/settings/show_admin', '__return_false');

add_action('wp_enqueue_scripts', 'jquery_cdn');
function jquery_cdn(){
  if(!is_admin()){
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', false, null, true);
    wp_enqueue_script('jquery');
  }
}

add_action('wp_enqueue_scripts', 'cai_scripts');
function cai_scripts(){
  wp_register_script(
    'bootstrap-scripts',
    'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js',
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

add_filter('script_loader_tag', 'cai_add_script_meta', 10, 2);
function cai_add_script_meta($tag, $handle){
  switch($handle){
    case 'jquery':
      $tag = str_replace('></script>', ' integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>', $tag);
      break;

    case 'bootstrap-scripts':
      $tag = str_replace('></script>', ' integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>', $tag);
      break;
  }

  return $tag;
}

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

add_action('enqueue_block_editor_assets', 'cai_admin_styles');
function cai_admin_styles(){
  wp_enqueue_style(
    'editor-style',
    get_stylesheet_directory_uri() . '/editor.css'
  );
}

add_action('after_setup_theme', 'cai_setup');
function cai_setup(){
  add_theme_support('post-thumbnails');
  //set_post_thumbnail_size(320, 320);

  add_theme_support(
    'html5',
    array(
      'comment-form',
      'comment-list',
      'gallery',
      'caption'
    )
  );

  add_theme_support('editor-styles');
  add_theme_support('wp-block-styles');
  add_theme_support('responsive-embeds');

  register_nav_menus(array(
    'header-nav' => 'Header Navigation',
    'footer-nav' => 'Footer Navigation',
  ));

  load_theme_textdomain('cai', get_stylesheet_directory_uri() . '/languages');
}

require_once dirname(__FILE__) . '/includes/class-wp-bootstrap-navwalker.php';