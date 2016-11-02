<?php if ($url): ?>
  <a class="display--block" href="<?php print $url; ?>">
<?php endif; ?>

<div class="width--100 display--table overflow--hidden <?php print $classes; ?> <?php print $classes_plus; ?>">
  <div class="<?php print $media_classes;?> display--table-cell position--relative background-size--cover background-position--center overflow--hidden" style="background-image: url(<?php print $media_uri;?>)">

    <?php if ($caption): ?>
      <div class="position--absolute bottom width--100 color--<?php print $text_color;?> bg--<?php print $bg_color;?>--o40 padding--xs font-size--sm text-align--center"><?php print $caption; ?></div>
    <?php endif; ?>
    <?php if ($video_embed): ?>
      <a href="#<?php print $random; ?>" class="modal-trigger width--100 height--100 top bottom left right position--absolute display--block">
        <div class="padding-left--xs"><i class=" font-size--xxl icon-play-circled bg--black--o90 color--white border-radius--md"></i></div>
      </a>
    <?php endif; ?>
  </div>
  <div class="display--table-cell width--auto">
    <?php if ($title): ?>
      <div class="bold caps font-size--lg margin--md"><?php print $title; ?></div>
    <?php endif; ?>
    <?php if ($description): ?>
      <div class="margin--md"><?php print $description; ?></div>
    <?php endif; ?>
  </div>
</div>

<?php if ($url): ?>
  </a>
<?php endif; ?>


<?php if ($video_embed): ?>
  <div id="<?php print $random; ?>" class="modal bg--white padding--xl mfp-hide">
    <div class="max-width--xxxl padding--lg center">
      <div class="video-wrapper"><?php print $video_embed; ?></div>
    </div>
  </div>
<?php endif; ?>
