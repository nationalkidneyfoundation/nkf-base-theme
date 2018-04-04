<?php
  /*
   * @file
   * Template for summary text.
   *
   * Variables:
   * - $title: Optional title.
   * - $media: Image or video
   *
   */
?>

<div class="container center padding-x--md md--padding-x--xxxl padding-y--xl">
  <?php if (!empty($title)): ?>
    <h3><?php print $title;?></h3>
  <?php endif;?>
  <div class="">
    <?php print $media;?>
  </div>
</div>
