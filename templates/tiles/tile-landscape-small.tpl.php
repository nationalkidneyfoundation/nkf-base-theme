<?php
/**
  *
  */

?>
<div class="position--relative padding-y--xxs mutelink">
  <a href="<?php print $path ?>" class="zoom-image display--flex">
    <div class="width--100">
      <?php if (!empty($title_prefix)): ?>
        <div class="font-size--sm caps">
          <?php print $title_prefix ?>
        </div>
      <?php endif;?>
      <div class=" ">
        <?php print $title ?>
      </div>
    </div>
    <?php if(isset($image) && FALSE):?>
      <div class="margin-left--sm flex-shrink--0 overflow--hidden">
        <?php print nkf_base_style_image($image, 'resize', 65, 65, 'display--block rounded');?>
      </div>
    <?php endif; ?>
  </a>
</div>
