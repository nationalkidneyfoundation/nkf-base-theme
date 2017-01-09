<?php if (!empty($url)): ?>
  <a class="display--block" href="<?php print $url; ?>">
<?php endif; ?>

<div class="width--100 overflow--hidden <?php print $classes; ?> <?php print $classes_plus; ?>">
  <?php if (!empty($title)): ?>
    <div class="bold caps font-size--lg margin--md"><?php print $title; ?></div>
  <?php endif; ?>
  <?php if (!empty($description)): ?>
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

<?php if (!empty($url)): ?>
  </a>
<?php endif; ?>


<?php if (!empty($video_embed)): ?>
  <div id="<?php print $random; ?>" class="modal--full padding--xl mfp-hide">
    <div class="max-width--xxxl center">
      <div class="video-wrapper"><?php print $video_embed; ?></div>
    </div>
  </div>
<?php endif; ?>
