
<?php if ($title_anchor): ?>
  <a name="<?php print $title_anchor; ?>"></a>
<?php endif; ?>

<?php if ($title): ?>
  <h3><?php print $title;?></h3>
<?php endif;?>
<div class="<?php print $classes; ?>" <?php print $attributes; ?>>
  <?php print $body;?>
</div>
