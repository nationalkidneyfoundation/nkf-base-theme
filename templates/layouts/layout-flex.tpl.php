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
  <div class="border-width--none border-top-width--sm border-color--gray-4 border-style--solid">
    <?php print theme('nkf_base_section_header', array('header' => $header)); ?>
    <?php print theme('nkf_base_section_subheader', array('subheader' => $subheader)); ?>
  </div>
</div>
<div class="display--flex flex-direction--row flex-wrap--wrap align-items--flex-start">
  <?php foreach($sections as $i => $section): ?>

    <div class="padding-bottom--xl md--padding-bottom--none <?php print $column_css[$i]; ?>">
      <?php print $section;?>
    </div>

  <?php endforeach; ?>
</div>
