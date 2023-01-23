<?php if(function_exists('wp_pagenavi')): ?>
  <div class="cai-pagination my-5 text-center">
    <?php 
      if(isset($args['query']) && $args['query'] !== ''){
        wp_pagenavi(array('query' => $args['query']));
      }
      else{
        wp_pagenavi();
      }
    ?>
  </div>
<?php else: ?>
  <?php if(WP_DEBUG == true && current_user_can('manage_options')): ?>
    <div class="cai-pagination my-5 text-center">
      <p><?php echo esc_html__('Warning... WP Pagenavi plugin is not installed.', 'cai'); ?></p>
    </div>
  <?php endif; ?>
<?php endif; ?>