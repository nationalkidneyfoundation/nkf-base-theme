<?php


?>
<section class="padding-y--xxl margin-y--xxl">
  <?php if ($title_anchor): ?>
    <a name="<?php print $title_anchor; ?>"></a>
  <?php endif; ?>
  <div class="tabbed-slider--container <?php print $classes; ?>" <?php print $attributes; ?>>
    <?php print render($title_prefix); ?>
    <?php print render($title_suffix); ?>
    <?php if ($title): ?>
      <h2 class="text-align--center font-size--xxl font-weight--400 padding-bottom--none"><?php print $title;?></h2>
    <?php endif;?>
    <?php if ($body): ?>
      <div class="prose center text-align--center"><?php print $body;?></div>
    <?php endif;?>
    <div class="tabbed-slider--nav display--flex justify-content--center max-width--xxxl center">
      <?php foreach($nav_items as $i => $item): ?>
        <div class="position--relative item--<?php print $i; ?> width--0 flex-grow--1
                    padding-x--md padding-top--xxl padding-bottom--xl cursor--pointer
                    word-break--break-word
                    <?php print $i==0?'active':''?>"
             data-toggle="class"
             data-class="active|active"
             data-target="#<?php print $id;?> .active|#<?php print $id;?> .item--<?php print $i; ?>">
          <?php print $item; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="tabbed-slider--slider bg--gray-1">
      <?php foreach($slider_items as $item): ?>
        <?php print $item; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
