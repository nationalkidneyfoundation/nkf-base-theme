<?php

?>
<div class="grid" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <div class="grid-cell col-12">
    <?php print $content['top']; ?>
  </div>
  <div class="grid-cell md-col-9">
    <?php print $content['left']; ?>
  </div>
  <div class="grid-cell md-col-3">
    <?php print $content['right']; ?>
  </div>
  <div class="grid-cell col-12">
    <?php print $content['bottom']; ?>
  </div>
</div>
