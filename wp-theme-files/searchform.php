<form id="search-form" action="<?php echo esc_url(home_url()); ?>" method="get">
  <input type="text" 
      name="s" 
      class="form-control" 
      placeholder="<?php echo esc_html__('Search...', 'cai'); ?>"
      aria-label="<?php echo esc_html__('Search', 'cai'); ?>" />
</form>