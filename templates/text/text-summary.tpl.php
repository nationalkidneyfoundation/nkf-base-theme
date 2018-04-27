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

<?php if ($title_anchor): ?>
  <a name="<?php print $title_anchor; ?>"></a>
<?php endif; ?>

<div class="prose center padding-x--md md--padding-x--xxxl <?php print $classes; ?>" <?php print $attributes; ?>>
  <?php if (!empty($title)): ?>
    <h2><?php print $title;?></h2>
  <?php endif;?>
  <div class="font-size-md md--font-size--lg padding-top--md">
    <?php print $body;?>
  </div>
</div>
