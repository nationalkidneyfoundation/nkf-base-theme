<div class="this">
  <?php if ($title_anchor): ?>
          <a name="<?php print $title_anchor; ?>"></a>
  <?php endif; ?>

  <div class="prose center padding-x--md <?php print $classes; ?>" <?php print $attributes; ?>>
    <?php print render($title_prefix); ?>
    <?php print render($title_suffix); ?>
    
    <?php if ($title): ?>
      <h2><?php print $title;?></h2>
    <?php endif;?>

  <!-- LEFT CONTENT -->
    <?php if ($offset_left): ?>
      <div class="sm--float--left sm--max-width--lg md--margin-left--xxxl-  sm--padding-right--xxxl padding-bottom--lg bold font-size--lg">
        <?php print $offset_content; ?>
      </div>
    <?php endif; ?>

  <!-- RIGHT CONTENT -->
    <?php if ($offset_right): ?>
      <div class="sm--float--right sm--max-width--lg md--margin-right--xxxl-  sm--padding-left--xxxl padding-bottom--lg bold font-size--lg">
        <?php print $offset_content; ?>
      </div>
    <?php endif; ?>

  <!-- BODY -->
    <?php print $body;?>
   
</div>
