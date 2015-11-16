<?php

?>
<div class="grid" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <?php if (!empty($content['top'])):?>
  <div class="grid-cell width--100 padding-y--lg">
    <?php print $content['top']; ?>
  </div>
  <?php endif; ?>
  <?php if (!empty($content['left'])):?>
  <div class="grid-cell sm--width--60 width--100 padding-y--lg sm--padding-right--lg">
    <?php print $content['left']; ?>
  </div>
  <?php endif; ?>
  <?php if (!empty($content['right'])):?>
  <div class="grid-cell sm--width--40 width--100 padding-y--lg sm--padding-left--lg">
    <?php print $content['right']; ?>
  </div>
  <?php endif; ?>
  <?php if (!empty($content['bottom'])):?>
  <div class="grid-cell width--100 padding-y--lg">
    <?php print $content['bottom']; ?>
  </div>
  <?php endif; ?>
</div>
