<?php
/**
 * Home page template file when Settings -> Reading -> Homepage is set.
 */

get_header(); ?>
<main id="main">
  <div class="container-fluid">
    <?php
      if(have_posts()){
        while(have_posts()){
          the_post(); 
          the_content();

          get_template_part('partials/content', 'edit_link');
        }
      }
    ?>
  </div>
</main>
<?php get_footer(); ?>