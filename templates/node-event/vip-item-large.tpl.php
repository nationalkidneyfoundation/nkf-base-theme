
<div class="grid-cell width--100 padding-bottom--sm clearfix">
  <?php if(isset($row['field_base_image'])): ?>
    <?php if(isset($row['field_base_link'])): ?>
      <a href="<?php print $row['field_base_link']['url'];?>" class="display--block color--gray-4">
    <?php endif;?>
    <img
      src="<?php print nkf_base_image_url($row['field_base_image']['#path'],'extra_large_landscape'); ?>"
      class="display--block"
      title="<?php print $row['field_base_image']['#title']; ?>"
      alt="<?php print $row['field_base_image']['#alt']; ?>"/>
    <?php if(isset($row['field_base_link'])): ?>
      </a>
    <?php endif;?>
  <?php endif; ?>
  <?php if(isset($row['field_vip_name']) || isset($row['field_vip_description'])): ?>
    <div class="padding-top--md">
      <div class="bold"><?php print $row['field_vip_name']; ?></div>
      <div class=""><?php print $row['field_vip_description']; ?></div>
    </div>
  <?php endif;?>
</div>
