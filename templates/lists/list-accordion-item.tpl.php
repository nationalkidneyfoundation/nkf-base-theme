<div id="<?php print $iid;?>" class="position--relative margin-y--md padding--md bg--white rounded">
  <div class="position--absolute left top padding-y--md padding-left--sm width--md cursor--pointer" data-toggle="class" data-target="#<?php print $iid;?> i|#<?php print $iid;?> .desc" data-class="hide|hide">
    <i class="icon-down-open position--absolute bg--gray-4 color--white rounded"></i>
    <i class="hide icon-up-open position--absolute bg--gray-4 color--white rounded"></i>
  </div>
  <div class="margin-left--xl bold cursor--pointer" data-toggle="class" data-target="#<?php print $iid;?> i|#<?php print $iid;?> .desc" data-class="hide|hide">
    <?php print $title; ?>
  </div>
  <div class="desc hide margin-left--xl padding-y--xs">
    <?php print $description; ?>
  </div>
  <?php print theme('grid_cell', array('content'=>$title)); ?>
</div>
