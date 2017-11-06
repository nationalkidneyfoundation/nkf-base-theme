<?php foreach($rows as $subsection): ?>
<div class="padding-bottom--lg">
  <h3 class="padding-bottom--sm caps">
    <?php print $subsection[0]['field_vip_subsection_text']; ?>
  </h3>
  <div class="grid width--100">

  <?php foreach($subsection as $row): ?>

    <?php if ($row['field_vip_format'] == '1'): ?>
      <?php include('vip-item-small.tpl.php'); ?>
    <?php endif; ?>

    <?php if ($row['field_vip_format'] == '2'): ?>
      <?php include('vip-item-medium.tpl.php'); ?>
    <?php endif; ?>

    <?php if ($row['field_vip_format'] == '3'): ?>
      <?php include('vip-item-large.tpl.php'); ?>
    <?php endif; ?>

  <?php endforeach;?>

  </div>
</div>
<?php endforeach;?>
