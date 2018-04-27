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
   * - $caption: optional caption text for images
   *
   */
   //dpm(get_defined_vars());
?>
<?php if ($title_anchor): ?>
  <a name="<?php print $title_anchor; ?>"></a>
<?php endif; ?>

<div class="prose center padding-x--md md--padding-x--xxxl <?php print $classes; ?>" <?php print $attributes; ?>>
  <?php if ($title): ?>
    <h2><?php print $title;?></h2>
  <?php endif;?>
  <div class="">

    <!-- LEFT CONTENT -->
    <?php if ($offset_left): ?>
      <div class="sm--float--left sm--max-width--lg
                  md--margin-left--xxxl-  sm--padding-right--xxxl padding-bottom--lg
                  bold font-size--lg">
        <?php print $offset_content; ?>
      </div>
    <?php endif; ?>

    <!-- RIGHT CONTENT -->
    <?php if ($offset_right): ?>
      <div class="sm--float--right sm--max-width--lg
                  md--margin-right--xxxl-  sm--padding-left--xxxl padding-bottom--lg
                  bold font-size--lg">
        <?php print $offset_content; ?>
      </div>
    <?php endif; ?>

    <!-- BODY -->
    <?php print $body;?>

  </div>

</div>
