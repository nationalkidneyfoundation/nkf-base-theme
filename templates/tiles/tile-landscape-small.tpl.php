<?php
/**
  *
  */
?>
<div class="position--relative max-width--xl padding-bottom--sm">
  <a href="<?php print $path ?>" class="display--flex align-items--center">

    <?php if(isset($img_src)):?>
      <div class="padding-right--sm">
        <img class="width--100 height--auto display--block"
             typeof="foaf:Image"
             src="<?php print nkf_base_image_url($img_src, 'resize', 65, 65) ; ?>">
      </div>
    <?php endif; ?>

    <div class="padding-right--sm">
      <?php if (!empty($title_prefix)): ?>
        <div class="font-size--sm caps">
          <?php print $title_prefix ?>
        </div>
      <?php endif;?>
      <div class="">
        <?php print $title ?>
      </div>
    </div>
  </a>
</div>
