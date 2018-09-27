<?php
  /*
   * @file
   * Template for 30/30/30 layout
   *
   * Variables:
   * - $bg_color: background color class.
   * - $left:
   * - $center:
   * - $right:
   *
   */
?>
<div class="padding-x--md">
  <div class="border-width--none border-top-width--sm border-color--gray-4 border-style--solid">
    <?php print theme('nkf_base_section_header', array('header' => $title)); ?>
    <?php print theme('nkf_base_section_subheader', array('subheader' => $body)); ?>
  </div>
</div>
<div class="display--flex flex-direction--row flex-wrap--wrap align-items--flex-start">
  <div class="width--100 md--width--33 md--padding-bottom--xl padding-bottom--md">
    <?php print $left;?>
  </div>
  <div class="width--100 md--width--33 md--padding-bottom--xl padding-bottom--md">
    <?php print $center;?>
  </div>
  <div class="width--100 md--width--33 md--padding-bottom--xl padding-bottom--md">
    <?php print $right;?>
  </div>
</div>
