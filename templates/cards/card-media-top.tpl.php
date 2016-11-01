<?php if ($url): ?>
  <a class="display--block" href="<?php print $url; ?>">
<?php endif; ?>

<div class="width--100 overflow--hidden <?php print $classes; ?> <?php print $classes_plus; ?>">
  <div class="<?php print $media_classes;?> position--relative">
    <div class="<?php print $media_classes;?> background-size--cover background-position--center overflow--hidden" style="background-image: url(<?php print $media_uri;?>)">
    </div>
    <?php if ($caption): ?>
      <div class="position--absolute bottom width--100 color--<?php print $text_color;?> bg--<?php print $bg_color;?>--o40 padding--xs font-size--sm text-align--center"><?php print $caption; ?></div>
    <?php endif; ?>
    <?php if ($video_embed): ?>
      <a href="#<?php print $random; ?>" class="modal-trigger width--100 height--100 top bottom left right position--absolute display--block">
        <div class="padding-left--xs"><i class=" font-size--xxl icon-play-circled bg--black--o90 color--white border-radius--md"></i></div>
      </a>
    <?php endif; ?>
  </div>
  <div class="width--100 ">
    <?php if ($title): ?>
      <div class="bold caps font-size--lg margin--md"><?php print $title; ?></div>
    <?php endif; ?>
    <?php if ($description): ?>
      <div class="margin--md"><?php print $description; ?></div>
    <?php endif; ?>
    <?php if (!empty($action_links)) : ?>
      <div class="grid width--100 margin-top--md border-top">
      <?php foreach($action_links as $link) : ?>
        <div class="grid-cell text-align--center caps font-size--sm truncate width--<?php print $action_links_width; ?>">
          <?php print $link; ?>
        </div>
      <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php if ($url): ?>
  </a>
<?php endif; ?>


<?php if ($video_embed): ?>
  <div id="<?php print $random; ?>" class="modal--full padding--xl mfp-hide">
    <div class="max-width--xxxl center">
      <div class="video-wrapper"><?php print $video_embed; ?></div>
    </div>
  </div>
<?php endif; ?>
