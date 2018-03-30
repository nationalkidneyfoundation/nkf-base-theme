<div class="padding--lg bg--gray-1">
  <?php foreach($items as $item): ?>
    <?php print theme('list_accordion_item', $item); ?>
  <?php endforeach;?>
</div>
