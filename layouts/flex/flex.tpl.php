<?php

?>
<div class="container">
  <div class="grid" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
    <?php if (!empty($content['main'])):?>
      <?php print $content['main']; ?>
    <?php endif; ?>
  </div>
</div>
