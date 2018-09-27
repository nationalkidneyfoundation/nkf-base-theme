<div id="<?php print $iid;?>" class="padding--md">
  <a href="#" class="display--flex color--gray-4" data-toggle="class" data-target="#<?php print $iid;?> i|#<?php print $iid;?> .desc" data-class="hide|hide">
    <div class="cursor--pointer font-size--sm">
      <i class="icon-down-open color--gray-4"></i>
      <i class="hide icon-up-open color--orange"></i>
    </div>
    <div class="bold padding-left--sm">
      <?php print $title; ?>
    </div>
  </a>
  <div class="linkHighlight desc hide sm--margin-left--md padding-top--xxs sm--padding-left--sm">
      <?php print $description; ?>
  </div>
</div>