<?php
/**
  *
  */
?>
<div class="<?php print $classes; ?> border-radius--md bg--white border border-width--sm border-color--gray-4
            margin-bottom--lg position--relative padding-y--sm sm--margin-left--none margin-left--xl">
  <?php if (isset($path)):?>
  <a href="<?php print $path ?>" class="card-animate display--block zoom-image">
  <?php endif;?>
    <?php if(isset($badge)): ?>
      <div class="position--absolute margin-top--sm margin-left--xxl- display--flex align-items--center z-index--400 circle padding--md
        bg--gray-2 border border-width--xs border-color--gray-4">
        <div class="square--sm center">
          <?php print $badge; ?>
        </div>
      </div>
    <?php endif;?>
    <div class="padding-left--xxl">
      <?php if(isset($image)):?>
        <div class="padding-bottom--lg">
          <div class="width--100 overflow--hidden">
              <?php print nkf_base_style_image($image, 'resize', 400, 250, 'width--100 height--auto display--block');?>
          </div>
        </div>
      <?php endif; ?>
      <div class="color--gray-4 width-100 padding-x--md padding-y--xs">
        <?php if (!empty($title_prefix)): ?>
          <div class="font-size--sm caps">
            <?php print $title_prefix ?>
          </div>
        <?php endif;?>
        <div class="color--gray-4 font-size--lg bold padding-bottom--xs">
          <?php print $title ?>
        </div>
        <?php if (!empty($teaser)): ?>
          <div class="color--gray-4 ">
            <?php print $teaser ?>
          </div>
        <?php endif;?>
      </div>
      <?php if (isset($path)):?>
      <div class="display--flex align-items--center padding-x--md padding-top--sm padding-bottom--md position--absolute bottom width--100">
        <div class="linkHighlight margin-right--sm">
          <a href="<?php print $path ?>"> Learn More </a>
        </div>
      </div>
      <?php endif;?>
    </div>
  <?php if (isset($path)):?>
  </a>
  <?php endif;?>
</div>
