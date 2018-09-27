<?php
/**
  *
  */
?>
<div class="card border-radius--md overflow--hidden bg--white border border-width--sm border-color--gray-4
            margin-right--md margin-bottom--md position--relative padding-bottom--xxl">
  <a href="<?php print $path ?>" class="card-animate display--block zoom-image">
    <div class="padding-bottom--lg">
      <div class="width--100 overflow--hidden">
        <?php if(!empty($image)):?>
          <?php print nkf_base_style_image($image, 'resize', 400, 250, 'width--100 height--auto display--block');?>
        <?php endif; ?>
      </div>
      <?php if (!empty($title_prefix)):?>
        <div class="font-size--sm caps">
          <?php print $title_prefix ?>
        </div>
      <?php endif;?>
  <div class="color--gray-4 font-size--log bold padding--md">
    <?php print $title ?>
  </div>
  <?php if (empty($image)):?>
    <?php if (!empty($teaser)): ?>
      <div class="color--gray-4 padding-x--md">
        <?php print $teaser ?>
      </div>
    <?php endif;?>
</div>
  <?php endif;?>
  <div class="linkHighlight position--absolute padding-x--md padding-bottom--md bottom width--100 margin-right--sm">
      <a href="<?php print $path ?>"> Learn More </a>
    </div>
    </div>
  </a>
</div>
