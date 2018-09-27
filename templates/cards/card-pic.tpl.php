<?php
/**
  *
  */
?>
<div class="box-shadow border-radius--md bg--white
            width--lg margin--sm position--relative padding-bottom--xxl">
  <a href="<?php print $path ?>" class="display--block">
    <div class="padding-bottom--lg">
      <div class="width--100">
        <?php if(isset($img_src)):?>
        <img class="zoom-image width--100 height--auto display--block"
             typeof="foaf:Image"
             src="<?php print nkf_base_image_url($img_src, 'resize', 400, 250) ; ?>">
           <?php endif; ?>
      </div>
    </div>
    <div class="color--gray-4 width-100 padding-x--md padding-top--xs padding-bottom--lg">
      <?php if (!empty($title_prefix)): ?>
        <div class="font-size--sm caps">
          <?php print $title_prefix ?>
        </div>
      <?php endif;?>
      <div class="color--gray-4 font-size--lg bold padding-bottom--xs">
        <?php print $title ?>
      </div>
      <?php if (!empty($description) && empty($img_src)): ?>
        <div class="color--gray-4 ">
          <?php print $description ?>
        </div>
      <?php endif;?>
    </div>
  </a>
  <div class="padding-x--md padding-y--sm position--absolute bottom width--100">
    <a href="<?php print $path ?>">Learn More</a>
  </div>
</div>
