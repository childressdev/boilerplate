<?php
  $bg_image = get_field('hero_background_image');
  $bg_pos_x = get_field('hero_background_image_position_x');
  $bg_pos_y = get_field('hero_background_image_position_y');

  if(!$bg_image){
    $bg_image = get_field('default_hero_background_image', 'option');
  }

  if(!$bg_pos_x){
    $bg_pos_x = 'center';
  }

  if(!$bg_pos_y){
    $bg_pos_y = 'center';
  }

  $bg_style = 'background-image:url(' . esc_attr($bg_image['url']) . ');';
  $bg_style .= 'background-position:' . esc_attr($bg_pos_x) . ' ' . esc_attr($bg_pos_y) . ';';

  $slide_speed = get_field('hero_slide_speed');
  if(!$slide_speed){ $slide_speed = 3; }
  $slide_speed = $slide_speed * 1000;
?>
<div class="swiper-slide hero-slide" 
    data-swiper-autoplay="<?php echo esc_attr($slide_speed); ?>"
    style="<?php echo esc_attr($bg_style); ?>">
  <div class="hero-overlay"></div>
  <div class="container-fluid">
    <div class="hero-content">
      <InnerBlocks />
    </div>
  </div>
</div>