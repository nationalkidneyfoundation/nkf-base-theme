<?php
/**
  *
  */
?>
<div class="position--relative max-width--xxl width--100 padding-bottom--lg">
  <a href="<?php print $path ?>" class="display--flex">

    <?php if(isset($img_src)):?>
      <div class="padding-right--sm width--40">
        <img class="width--100 height--auto display--block"
             typeof="foaf:Image"
             src="<?php print nkf_base_image_url($img_src, 'resize', 120, 160) ; ?>">
      </div>
    <?php endif; ?>

    <div class="padding-right--sm width--60">
      <?php if (!empty($title_prefix)): ?>
        <div class="font-size--sm caps">
          <?php print $title_prefix ?>
        </div>
      <?php endif;?>
      <div class="bold">
        <?php print $title ?>
      </div>
      <?php if (!empty($description)): ?>
        <div class="color--gray-4 ">
          <?php print $description ?>
        </div>
      <?php endif;?>
    </div>
  </a>
</div>
