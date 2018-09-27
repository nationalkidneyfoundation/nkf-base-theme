

<?php if ($title_anchor): ?>
  <a name="<?php print $title_anchor; ?>"></a>
<?php endif; ?>

<div class="padding-y--xxl padding-x--md <?php print $classes; ?>" <?php print $attributes; ?>>
  <?php if ($title): ?>
    <h2><?php print $title;?></h2>
  <?php endif;?>
  <div class="container display--flex flex-direction--row flex-wrap--wrap">
    <?php foreach($items as $i => $item): ?>
      <?php if ($i > 0): ?>
        <div class="padding-top--xxs margin-top--xxs border-top border-top-width--sm border-color--gray-4 width--50"></div>
      <?php endif; ?>
      <?php print $item ?>
    <?php endforeach;?>
  </div>
</div>
