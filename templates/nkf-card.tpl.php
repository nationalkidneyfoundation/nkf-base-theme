
<?php
/**
 * @file
 * Default theme implementation for cards.
 *
 * Available variables:
 * - $classes:
 * - $title: The (sanitized) entity label.
 */
?>

<div class="position--relative width--100 <?php print $classes; ?>">
  <div class="height--70 background-size--cover background-position--center overflow--hidden" style="background-image: url({{img}})"></div>
  <div class="height--30 position--absolute bottom width--100 padding-x--sm padding-y--md text-align--center">
    <div class="font-size--sm ">{{ caption }}</div>
    <div class="font-size--lg bold">{{ title }}</div>
    <div class="">{{ description }}</div>
  </div>
</div>
