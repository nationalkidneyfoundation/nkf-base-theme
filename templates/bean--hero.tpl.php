<div class="width--100 overflow--hidden position--relative background-size--cover background-position--center height--<?php print $height; ?> <?php print $classes; ?>" style="background-image: url(<?php print $media_uri;?>)">
  <?php if ($description): ?>
    <div class="position--absolute padding--md <?php print $content_classes; ?>"><?php print $description; ?></div>
  <?php endif; ?>
</div>

<?php if ($video_embed): ?>
  <div id="<?php print $random; ?>" class="modal--full padding--xl mfp-hide">
    <div class="max-width--xxxl center">
      <div class="video-wrapper"><?php print $video_embed; ?></div>
    </div>
  </div>
<?php endif; ?>
