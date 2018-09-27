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
   * prose center padding-x--md md--padding-x--xxxl
   */
   //dpm(get_defined_vars());
?>
<?php print theme( 'nkf_base_section_sm_header', array( 'smheader'=>$title)); ?>
<div class="linkHighlight">
  <!-- LEFT CONTENT -->
    <?php if ($offset_left): ?>
      <div class="sm--float--left sm--max-width--lg
                md--margin-left--xxl- padding-bottom--lg sm--padding-right--xxl">
        <?php print ($offset_content); ?>
        <?php print theme('nkf_base_section_caption', array('caption' => $caption)); ?>
      </div>
  <?php endif;?>

  <!-- RIGHT CONTENT -->
    <?php if ($offset_right): ?>
      <div class="sm--float--right sm--max-width--lg
                md--margin-right--xxl- sm--padding-left--xxl padding-bottom--lg">
        <?php print $offset_content; ?>
        <?php print theme('nkf_base_section_caption', array('caption' => $caption)); ?>
      </div>
  <?php endif; ?>

  <!-- BODY -->
  <?php print $body;?>
</div>
