
<?php print theme('nkf_base_section_header', array('header' => $title)); ?>
<?php print theme('nkf_base_section_subheader', array('subheader' => $body)); ?>

<div class="slider container display--flex align-items--center position--relative">
  <?php foreach($items as $item): ?>
    <?php print $item ?>
  <?php endforeach;?>
</div>
