<?php
/**
  *
  */
?>

<a href="<?php print $path ?>" class="display--block color--gray-4">
  <div class="box-shadow border-radius--md bg--white min-height--xl max-width--xl padding-bottom--xxl position--relative">
    <div class="position--relative padding-bottom--xxl">
      <div class="position--absolute bottom left width--100 padding-left--md">
        <div class="square--md circle position--relative font-size--lg display--inline-block text-align--center line-height--80 bg--orange color--white ">
          <div class="centered position--absolute width--100">
            <div class="font-size--sm caps"><?php print $month; ?></div>
            <div class="bold"><?php print $day; ?></div>
          </div>
        </div>
      </div>
      <?php if(isset($img_src)):?>
        <div class="width--100">
        <img class="width--100 height--auto display--block" typeof="foaf:Image" src="<?php print nkf_base_image_url($img_src, 'resize', 400, 250) ; ?>">
        </div>
      <?php endif;?>
    </div>
    <div class="width-100 padding-x--md padding-top--xs padding-bottom--lg">
      <?php if (!empty($title_prefix)): ?>
        <div class="font-size--sm caps">
          <?php print $title_prefix ?>
        </div>
      <?php endif;?>
      <div class="font-size--lg bold">
        <?php print $title ?>
      </div>
      <?php if (!empty($description)): ?>
        <div class="">
          <?php print $description ?>
        </div>
      <?php endif;?>
    </div>
    <div class="padding--md position--absolute bottom">
      <a href="<?php print $path ?>">Learn More</a>
    </div>
  </div>
</a>