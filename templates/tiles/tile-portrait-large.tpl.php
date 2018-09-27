<?php
/**
  *
  */
?>
<div class="position--relative max-width--xxxl width--100 mutelink">
  <a href="<?php print $path ?>" class="zoom-image display--flex flex-direction--column">

    <?php if(isset($image)):?>
      <div class="overflow--hidden">
        <?php print nkf_base_style_image($image, 'resize', 600, 400, 'display--block rounded');?>
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
      <?php if (!empty($teaser)): ?>
        <div class="color--gray-4 ">
          <?php print $teaser; ?>
        </div>
      <?php endif;?>
    </div>
  </a>
</div>
