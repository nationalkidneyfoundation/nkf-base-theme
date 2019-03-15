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
<?php if ($header || $subheader):?>
<div class="padding-x--md">
  <?php if ($header):?>
  <div class="padding-bottom--sm">
    <?php print theme('nkf_base_section_header', array('header' => $header)); ?>
  </div>
<?php endif;?>
    <?php print theme('nkf_base_section_subheader', array('subheader' => $subheader)); ?>
</div>
<?php endif;?>
<div class="display--flex flex-direction--row flex-wrap--wrap align-items--flex-start justify-content--space-evenly">
  <?php foreach($sections as $i => $section): ?>

    <div class="padding-bottom--xl md--padding-bottom--none <?php print $column_css[$i]; ?>">
      <?php print $section;?>
    </div>

  <?php endforeach; ?>
</div>
