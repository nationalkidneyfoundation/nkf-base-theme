<?php
  /*
   * @file
   * Template for summary text.
   *
   * Variables:
   * - $title: Optional title.
   * - $body: Place where stuff goes.
   *
   */
?>

<div class="margin-bottom--md">
  <?php print theme('nkf_base_section_header', array('header' => $title)); ?>
  <div class="linkHighlight font-size--lg padding-top--md">
    <?php print $body;?>
  </div>
</div>
