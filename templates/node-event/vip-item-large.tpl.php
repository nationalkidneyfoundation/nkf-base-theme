<div class="grid-cell width--100 padding-bottom--sm clearfix">
  <?php if(isset($row['field_base_image'])): ?>
    <img
      src="<?php print nkf_base_get_image_style_url($row['field_base_image']['#path'],'extra_large_landscape'); ?>"
      class="display--block"
      title="<?php print $row['field_base_image']['#title']; ?>"
      alt="<?php print $row['field_base_image']['#alt']; ?>"/>
  <?php endif; ?>
  <?php if(isset($row['field_vip_name']) || isset($row['field_vip_description'])): ?>
    <div class="padding-top--md">
      <div class="bold"><?php print $row['field_vip_name']; ?></div>
      <div class=""><?php print $row['field_vip_description']; ?></div>
    </div>
  <?php endif;?>
</div>
