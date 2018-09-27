<?php
  /*
   * @file
   * Template for 50 x 50 layout.
   *
   * Variables:
   * - $bg_color: background color class.
   * - $left: .
   * - $right:
   *
   */
?>

<div class="padding-x--md">
  <?php print theme('nkf_base_section_header', array('header' => $title)); ?>
  <?php print theme('nkf_base_section_subheader', array('subheader' => $body)); ?>
</div>
<div class="display--flex flex-direction--row flex-wrap--wrap align-items--flex-start">
  <div class="width--100 md--width--50 padding-bottom--xl md--padding-bottom--none md--padding-right--lg">
    <?php print $left;?>
  </div>
  <div class="width--100 md--width--50 padding-bottom--xl md--padding-bottom--none md--padding-left--lg">
    <?php print $right;?>
  </div>
</div>
