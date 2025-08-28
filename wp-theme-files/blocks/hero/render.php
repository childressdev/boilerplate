<section id="hero" class="hero container-breakout">
  <?php
    $transition_speed = get_field('slide_transition_speed');
    if(!$transition_speed){ $transition_speed = 300; }
  ?>
  <div class="swiper" data-speed="<?php echo esc_attr($transition_speed); ?>">
    <InnerBlocks class="swiper-wrapper" allowedBlocks="<?php echo esc_attr(wp_json_encode(['cai/hero-slide'])); ?>" />
    <div class="hero-pagination"></div>
    <div class="hero-slider-nav swiper-button-prev"></div>
    <div class="hero-slider-nav swiper-button-next"></div>
  </div>
</section>