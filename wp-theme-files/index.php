<?php get_header(); ?>
<main id="main">
  <div class="container-fluid">
    <?php 
      if(have_posts()){
        while(have_posts()){
          the_post();

          if(is_archive() || is_search()){
            get_template_part('partials/content', 'post_summary');
          }
          else{
            the_content();
          }
        }

        if(is_archive() || is_search()){
          get_template_part('partials/content', 'pagination');
        }
      }
      else{
        get_template_part('partials/content', 'none');
      }
    ?>
  </div>
</main>
<?php get_footer();