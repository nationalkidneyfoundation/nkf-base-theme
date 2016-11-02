<?php
?>
<?php if($flavor == 'media-top'): ?>
  <?php include 'cards/card-media-top.tpl.php'; ?>
<?php else if($flavor == 'media-left'): ?>
  <?php include 'cards/card-media-left.tpl.php'; ?>
<?php else: ?>
  <?php include 'cards/card-nomedia.tpl.php'; ?>
<?php endif; ?>
