<?php
namespace FXBGVIOLINS\shortcodes;

if(!defined('ABSPATH')){ exit; }

function register_shortcode(){
  add_shortcode('cai_videos', __NAMESPACE__ . '\cai_videos_shortcode');
}

function videos_shortcode($atts = array()){
  $options = shortcode_atts(
    array(
      'posts_per_page' => 9,
      'category' => 'all'
    ),
    $atts,
    'cai_videos'
  );

  $paged = get_query_var('paged') ? get_query_var('paged') : 1;

  $video_args = array(
    'post_type' => 'video',
    'post_status' => 'publish',
    'paged' => $paged,
    'posts_per_page' => $options['posts_per_page'],
  );

  if($options['category'] !== 'all'){
    $video_args['tax_query'] = array(
      array(
        'taxonomy' => 'video_category',
        'field' => 'slug',
        'terms' => sanitize_title($options['category'])
      )
    );
  }

  $output = '';
  $videos = new WP_Query($video_args);
  if($videos->have_posts()){
    ob_start();
    echo '<div class="video-grid">';

      while($videos->have_posts()){
        $videos->the_post();
        get_template_part('partials/content', 'video_card');
      }

    echo '</div>';

    $args['query'] = $videos;
    get_template_part('partials/content', 'pagination', $args);

    $output .= ob_get_contents();
    ob_end_clean();
  }
  else{
    get_template_part('partials/content', 'none');
  }
  wp_reset_postdata();

  return $output;
}