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
   * - $field_base_pullquote: pull quote, can have left or right orientation.
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

    <!-- LEFT CONTENT -->
    <?php if ($offset_left): ?>
      <div class="sm--float--left sm--max-width--lg
                  md--margin-left--xxl- padding-bottom--lg sm--padding-right--xxl">
        <?php print ($offset_content); ?>
        <?php if ($caption): ?>
            <div class="font-size--sm">
              <?php print $caption; ?>
            </div>
        <?php endif; ?>
      </div>
   <?php endif;?>

  <!-- RIGHT CONTENT -->
    <?php if ($offset_right): ?>
      <div class="sm--float--right sm--max-width--lg
                  md--margin-right--xxl- sm--padding-left--xxl padding-bottom--lg">
          <?php print $offset_content; ?>
          <?php if ($caption): ?>
            <div class="font-size--sm">
              <?php print $caption; ?>
            </div>
          <?php endif;?>
      </div>
    <?php endif; ?>

  <!-- BODY -->
    <?php print $body;?>

</div>
