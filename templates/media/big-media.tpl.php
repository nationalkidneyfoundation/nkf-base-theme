<?php
  /*
   * @file
   * Template for summary text.
   *
   * Variables:
   * - $title: Optional title.
   * - $media: Image or video
   */
?>
<?php if ($title_anchor): ?>
  <a name="<?php print $title_anchor; ?>"></a>
<?php endif; ?>

<div class="prose center md--padding-x--xxxl padding-y--xl <?php print $classes; ?>">
  <?php if (!empty($title)): ?>
    <h2><?php print $title;?></h2>
  <?php endif;?>
  <div class="">
    <?php print $media;?>
    <?php if ($caption): ?>
          <div class="font-size--sm text-align--center">
            <?php print $caption; ?>
          </div>
        <?php endif; ?>
  </div>
</div>
