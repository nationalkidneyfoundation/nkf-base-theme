<?php if ($title_anchor): ?>
  <a name="<?php print $title_anchor; ?>"></a>
<?php endif; ?>
<div class="prose center padding-x--md md--padding-x--xxxl <?php print $classes; ?>" <?php print $attributes; ?>>
  <?php if ($title): ?>
    <h2><?php print $title;?></h2>
  <?php endif;?>
  <?php print $items;?>
</div>
