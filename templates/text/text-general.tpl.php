<?php
  /*
   * @file
   * Template for text.
   *
   * Variables:
   * - $title: Optional title.
   * - $body: Place where stuff goes.
   * - $left_media:
   * - $right_media:
   * - $left_pullquote:
   * - $right_pullquote:
   *
   */
   //dpm(get_defined_vars());
?>
<div class="position--relative <?php print $classes; ?>" <?php print $attributes; ?>>
  <?php if ($title): ?>
    <h3><?php print $title;?></h3>
  <?php endif;?>
  <div class="font-size--md">

    <!-- LEFT MEDIA -->
    <?php if ($left_media): ?>
      <div class="md--float--left margin-left--xxxl- md--max-width--lg md--padding-right--xxxl padding-bottom--lg">
        <?php print $left_media; ?>
      </div>
    <?php endif; ?>

    <!-- RIGHT MEDIA -->
    <?php if ($right_media): ?>
      <div class="md--float--right margin-right--xxxl- md--max-width--lg md--padding-left--xxxl padding-bottom--xs">
        <?php print $right_media; ?>
      </div>
    <?php endif; ?>

    <!-- LEFT PULL QUOTE -->
    <?php if ($left_pullquote): ?>
      <div class="md--float--left margin-left--xxxl- md--max-width--lg md--padding-right--xxxl padding-bottom--md bold font-size--lg">
        <?php print $left_pullquote; ?>
      </div>
    <?php endif; ?>

    <!-- RIGHT PULL QUOTE -->
    <?php if ($right_pullquote): ?>
      <div class="float--right margin-right--xxxl- md--max-width--lg padding-left--xxxl padding-bottom--lg bold font-size--lg">
        <?php print $right_pullquote; ?>
      </div>
    <?php endif; ?>


    <!-- BODY -->
    <?php print $body;?>

  </div>
  <?php if ($admin_footer): ?>
    <?php print $admin_footer;?>
  <?php endif;?>
</div>
