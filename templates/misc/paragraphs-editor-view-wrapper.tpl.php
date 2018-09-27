<div class="<?php print $classes; ?>" <?php print $attributes; ?>>
  <div class=""><?php print $title;?></div>
  <div class=""><?php print $actions;?></div>
  <div class=""><?php print $label;?></div>
  <div class=""><?php print $status;?></div>
  <a href="#" data-toggle="class" data-target="#<?php print $id;?> .paragraph-preview" data-class="hide">preview</a>
  <div class="paragraph-preview hide height--xl border border-width--md border-color--gray-4 overflow-y--scroll"><?php print $preview;?></div>
</div>
