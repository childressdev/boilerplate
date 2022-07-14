<?php
  $facebook = get_field('facebook', 'option');
  $twitter = get_field('twitter', 'option');
  $linkedin = get_field('linkedin', 'option');
  $instagram = get_field('instagram', 'option');
  $reddit = get_field('reddit', 'option');
  $tiktok = get_field('tiktok', 'option');
  $youtube = get_field('youtube', 'option');
  $pinterest = get_field('pinterest', 'option');
  $discord = get_field('discord', 'option');
  $telegram = get_field('telegram', 'option');
?>

<?php if($facebook): ?>
  <a href="<?php echo esc_url($facebook); ?>" aria-label="Facebook" target="_blank">
    <i aria-hidden="true">
      <svg class="social-icon">
        <use xlink:href="#icon-facebook" />
      </svg>
    </i>
    <span class="visually-hidden">Facebook</span>
  </a>
<?php endif; if($twitter): ?>
  <a href="<?php echo esc_url($twitter); ?>" aria-label="Twitter" target="_blank">
    <i aria-hidden="true">
      <svg class="social-icon">
        <use xlink:href="#icon-twitter" />
      </svg>
    </i>
    <span class="visually-hidden">Twitter</span>
  </a>
<?php endif; if($linkedin): ?>
  <a href="<?php echo esc_url($linkedin); ?>" aria-label="LinkedIn" target="_blank">
    <i aria-hidden="true">
      <svg class="social-icon">
        <use xlink:href="#icon-linkedin" />
      </svg>
    </i>
    <span class="visually-hidden">LinkedIn</span>
  </a>
<?php endif; if($instagram): ?>
  <a href="<?php echo esc_url($instagram); ?>" aria-label="Instagram" target="_blank">
    <i aria-hidden="true">
      <svg class="social-icon">
        <use xlink:href="#icon-instagram" />
      </svg>
    </i>
    <span class="visually-hidden">Instagram</span>
  </a>
<?php endif; if($reddit): ?>
  <a href="<?php echo esc_url($reddit); ?>" aria-label="Reddit" target="_blank">
    <i aria-hidden="true">
      <svg class="social-icon">
        <use xlink:href="#icon-reddit" />
      </svg>
    </i>
    <span class="visually-hidden">Reddit</span>
  </a>
<?php endif; if($tiktok): ?>
  <a href="<?php echo esc_url($tiktok); ?>" aria-label="TikTok" target="_blank">
    <i aria-hidden="true">
      <svg class="social-icon">
        <use xlink:href="#icon-tiktok" />
      </svg>
    </i>
    <span class="visually-hidden">TikTok</span>
  </a>
<?php endif; if($discord): ?>
  <a href="<?php echo esc_url($discord); ?>" aria-label="Discord" target="_blank">
    <i aria-hidden="true">
      <svg class="social-icon">
        <use xlink:href="#icon-discord" />
      </svg>
    </i>
    <span class="visually-hidden">Discord</span>
  </a>
<?php endif; if($youtube): ?>
  <a href="<?php echo esc_url($youtube); ?>" aria-label="YouTube" target="_blank">
    <i aria-hidden="true">
      <svg class="social-icon">
        <use xlink:href="#icon-youtube" />
      </svg>
    </i>
    <span class="visually-hidden">YouTube</span>
  </a>
<?php endif; if($pinterest): ?>
  <a href="<?php echo esc_url($pinterest); ?>" aria-label="Pinterest" target="_blank">
    <i aria-hidden="true">
      <svg class="social-icon">
        <use xlink:href="#icon-pinterest" />
      </svg>
    </i>
    <span class="visually-hidden">Pinterest</span>
  </a>
<?php endif; if($telegram): ?>
  <a href="<?php echo esc_url($telegram); ?>" aria-label="Telegram" target="_blank">
    <i aria-hidden="true">
      <svg class="social-icon">
        <use xlink:href="#icon-telegram" />
      </svg>
    </i>
    <span class="visually-hidden">Telegram</span>
  </a>
<?php endif;