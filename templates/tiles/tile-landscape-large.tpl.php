<?php
/**
  *
  */
?>
<div class="position--relative max-width--xxxl width--100 padding-bottom--lg">
  <a href="<?php print $path ?>" class="zoom-image display--flex">

    <?php if(isset($image)):?>
      <div class="padding-right--lg flex-shrink--0 overflow--hidden">
          <?php print nkf_base_style_image($image, 'resize', 170, 230, 'display--block rounded');?>
      </div>
    <?php endif; ?>

    <div class="padding-right--lg padding-top--md">
      <?php if (!empty($title_prefix)): ?>
        <div class="font-size--sm caps">
          <?php print $title_prefix ?>
        </div>
      <?php endif;?>
      <div class="bold font-size--lg padding-bottom--xs">
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
