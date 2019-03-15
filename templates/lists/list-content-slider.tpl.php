<?php if(!empty($title)):?>
  <div class="padding-bottom--xl">
    <?php print theme('nkf_base_section_header', array('header' => $title)); ?>
    <?php print theme('nkf_base_section_subheader', array('subheader' => $body)); ?>
  </div>
<?php endif;?>
<div class="slider container display--flex align-items--center position--relative">
  <?php foreach($items as $item): ?>
    <?php print $item ?>
  <?php endforeach;?>
</div>
