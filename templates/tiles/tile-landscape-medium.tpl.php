<?php
/**
  *
  */
?>
<div class="position--relative max-width--xxxl width--100 mutelink">
  <a href="<?php print $path ?>" class="zoom-image display--flex flex-direction--column">
    <div class="">
      <?php if (!empty($title_prefix)): ?>
        <div class="font-size--sm caps">
          <?php print $title_prefix ?>
        </div>
      <?php endif;?>
      <div class="bold padding-bottom--xxs">
        <?php print $title ?>
      </div>
      <?php if (!empty($tagline)): ?>
        <div class="color--gray-4 ">
          <?php if(isset($image)):?>
            <div class="overflow--hidden padding-left--sm float--right">
              <?php print nkf_base_style_image($image, 'resize', 65, 65, 'display--block rounded');?>
            </div>
          <?php endif; ?>
          <?php print $tagline ?>
        </div>
      <?php else: ?>
        <?php if(isset($image)):?>
          <div class="overflow--hidden padding-right--xs float--left">
            <?php print nkf_base_style_image($image, 'resize', 300, 250, 'display--block rounded');?>
          </div>
        <?php endif; ?>
      <?php endif;?>
    </div>
  </a>
</div>
