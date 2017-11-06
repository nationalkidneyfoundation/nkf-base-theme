<div class="grid-cell width--100 sm--width--50 md--width--33 padding-bottom--lg padding-right--lg">
  <?php if(isset($row['field_base_image'])): ?>
    <div class="height--md bg--white ">
      <img
        src="<?php print nkf_base_get_image_style_url($row['field_base_image']['#path'],'small'); ?>"
        class="centered display--block"
        title="<?php print $row['field_base_image']['#title']; ?>"
        alt="<?php print $row['field_base_image']['#alt']; ?>"/>
    </div>
  <?php endif; ?>
  <?php if(isset($row['field_vip_name']) || isset($row['field_vip_description'])): ?>
    <div class="">
      <div class="bold"><?php print $row['field_vip_name']; ?></div>
      <div class=""><?php print $row['field_vip_description']; ?></div>
    </div>
  <?php endif;?>
</div>
