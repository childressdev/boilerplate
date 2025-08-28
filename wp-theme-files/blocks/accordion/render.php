<?php if(have_rows('accordion_items')): ?>
  <?php $accordion_id = uniqid(); ?>
  <div id="acc-<?php echo $accordion_id; ?>" class="accordion">

    <?php $i = 0; while(have_rows('accordion_items')): the_row(); ?>
      <?php $accordion_id_i = $accordion_id . '-' . $i; ?>

      <div class="accordion-item">
        <h3 id="heading-<?php echo $accordion_id_i; ?>" class="accordion-header">
          <button type="button"
              class="accordion-button collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#content-<?php echo $accordion_id_i; ?>"
              aria-expanded="false"
              aria-controls="content-<?php echo $accordion_id_i; ?>">
            <?php the_sub_field('accordion_item_heading'); ?>
          </button>
        </h3>
        
        <div id="content-<?php echo $accordion_id_i; ?>"
            class="accordion-collapse collapse"
            aria-labelledby="heading-<?php echo $accordion_id_i; ?>"
            data-bs-parent="#acc-<?php echo $accordion_id; ?>">
          <div class="accordion-body">
            <?php the_sub_field('accordion_item_content'); ?>
          </div>
        </div>
      </div>

    <?php $i++; endwhile; ?>

  </div>
<?php endif;