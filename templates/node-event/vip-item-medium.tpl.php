<?php if(isset($row['field_base_link'])): ?>
  <a href="<?php print $row['field_base_link']['url'];?>" class="display--block color--gray-4">
<?php endif;?>
<div class="grid-cell width--100 padding-bottom--sm padding-right--sm clearfix">
  <?php if(isset($row['field_base_image'])): ?>
    <div class="height--lg padding-bottom--sm padding-right--lg float--left">
      <img
        src="<?php print nkf_base_get_image_style_url($row['field_base_image']['#path'],'large'); ?>"
        class="display--block"
        title="<?php print $row['field_base_image']['#title']; ?>"
        alt="<?php print $row['field_base_image']['#alt']; ?>"/>
    </div>
  <?php endif; ?>
  <?php if(isset($row['field_vip_name']) || isset($row['field_vip_description'])): ?>
    <div class="padding-top--sm">
      <div class="bold"><?php print $row['field_vip_name']; ?></div>
      <div class=""><?php print $row['field_vip_description']; ?></div>
    </div>
  <?php endif;?>
</div>
<?php if(isset($row['field_base_link'])): ?>
  </a>
<?php endif;?>