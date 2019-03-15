<?php

/**
 * @file
 * Table of contents list.
 *
 * Available variables:
 * $items: Array of navigation items with 'name' and 'path' variables
 */
?>


<ul class="list-style--dash padding-left--lg margin--none print--hide">
  <?php foreach($items as $i => $item): ?>
    <li class="">
      <a id="test-<?php print $i;?>" href="<?php print $item['path'];?>"
         class="display--inline-block padding-right--md padding-bottom--xxs">
        <?php print $item['title'];?>
      </a>
    </li>
  <?php endforeach;?>
</ul>
