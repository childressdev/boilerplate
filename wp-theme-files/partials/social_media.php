<?php if(have_rows('social_links', 'option')): ?>
  <?php while(have_rows('social_links', 'option')): the_row(); ?>
    <?php
      $platform = get_sub_field('platform');
      $link = get_sub_field('platform_link');
    ?>
    <a href="<?php echo esc_url($link); ?>" aria-label="<?php echo esc_attr($platform['label']); ?>" target="_blank">
      <i aria-hidden="true">
        <svg class="social-icon">
          <use href="#icon-<?php echo esc_attr($platform['value']); ?>" />
        </svg>
      </i>
      <span class="visually-hidden"><?php echo esc_html($platform['label']); ?></span>
    </a>
  <?php endwhile; ?>
<?php endif;