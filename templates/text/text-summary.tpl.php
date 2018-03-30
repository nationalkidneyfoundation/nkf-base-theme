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

<div class="prose center padding-x--md md--padding-x--none padding-bottom--lg <?php print $classes; ?>" <?php print $attributes; ?>>
  <?php if (!empty($title)): ?>
    <h3><?php print $title;?></h3>
  <?php endif;?>
  <div class="font-size--lg padding-top--md">
    <?php print $body;?>
  </div>
</div>
