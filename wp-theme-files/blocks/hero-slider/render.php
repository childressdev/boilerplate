<?php if(have_rows('hero_slides')): ?>
  <section id="hero-slider" class="hero container-breakout">
    <div class="swiper">
      <div class="swiper-wrapper">
        <?php while(have_rows('hero_slides')): the_row(); ?>
          <?php
            $hero_image = get_sub_field('hero_slide_image');
            if($hero_image){
              $hero_image = get_field('default_hero_slide_image', 'option');
            }
            $slide_speed = get_sub_field('hero_slide_speed');
            if(!$slide_speed){ $slide_speed = 3; }
            $slide_speed = $slide_speed * 1000;
          ?>
          <div class="swiper-slide" 
              data-swiper-autoplay="<?php echo esc_attr($slide_speed); ?>" 
              style="background-image:url(<?php echo esc_url($hero_image['url']); ?>);">
            <div class="row">
              <div class="col-lg-6">
                <div class="hero-slide-content">
                  <?php 
                    $subtitle = get_sub_field('hero_slide_subtitle');
                    $title = get_sub_field('hero_slide_title');
                    $caption = get_sub_field('hero_slide_caption');
                  ?>
                  <?php if($subtitle): ?>
                    <p><?php echo esc_html($subtitle); ?></p>
                  <?php endif; if($title): ?>
                    <h1><?php echo esc_html($title); ?></h1>
                  <?php endif; if($caption): ?>
                    <?php echo wp_kses_post($caption); ?>
                  <?php endif; ?>

                  <?php if(have_rows('hero_slide_buttons')): ?>
                    <?php while(have_rows('hero_slide_buttons')): the_row(); ?>
                      <?php
                        $btn_link = get_sub_field('button_link');
                        if($btn_link): ?>
                          <a href="<?php echo esc_url($btn_link['url']); ?>" class="btn-main">
                            <?php echo esc_html($btn_link['title']); ?>
                          </a>
                      <?php endif; ?>
                    <?php endwhile; ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
    <div class="hero-slider-pager swiper-pagination"></div>
  </section>
<?php endif;