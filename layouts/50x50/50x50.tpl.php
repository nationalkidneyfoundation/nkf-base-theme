<?php

?>
<div class="grid" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <div class="grid-cell width--100 padding--lg">
    <?php print $content['top']; ?>
  </div>
  <div class="grid-cell sm--width--50 width--100 padding-y--lg sm--padding-right--lg">
    <?php print $content['left']; ?>
  </div>
  <div class="grid-cell sm--width--50 width--100 padding-y--lg sm--padding-left--lg">
    <?php print $content['right']; ?>
  </div>
  <div class="grid-cell width--100 padding--lg">
    <?php print $content['bottom']; ?>
  </div>
</div>
