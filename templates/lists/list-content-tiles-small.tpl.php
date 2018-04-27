

<?php if ($title_anchor): ?>
  <a name="<?php print $title_anchor; ?>"></a>
<?php endif; ?>

<div class="padding-y--xxl padding-x--md <?php print $classes; ?>" <?php print $attributes; ?>>
  <?php if ($title): ?>
    <h2><?php print $title;?></h2>
  <?php endif;?>
  <div class="container display--flex flex-direction--column">
    <?php foreach($items as $item): ?>
      <?php print $item ?>
    <?php endforeach;?>
  </div>
</div>
