<?php
/**
 * @file field--fences-blockquote.tpl.php
 * Wrap each field value in the <blockquote> element.
 *border-style--solid border-left-width--md border-width--none border-color--orange
 * @see http://developers.whatwg.org/sections.html#the-blockquote-element
 */
?>
<?php foreach ($items as $delta => $item): ?>
  <blockquote class="bg--gray-1 padding-x--lg padding-y--sm font-style--italic border-left border-width--md border-color--orange" <?php print $attributes; ?>>
    <?php print render($item); ?>
  </blockquote>
<?php endforeach; ?>
