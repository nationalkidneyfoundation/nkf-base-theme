
<div class="grid-cell width--100 sm--width--50 md--width--33 padding-bottom--lg padding-right--lg">
  <?php if(isset($row['field_base_image'])): ?>
    <div class="height--md">
      <?php if(isset($row['field_base_link'])): ?>
        <a href="<?php print $row['field_base_link']['url'];?>" class="">
        <?php endif;?>
          <img
            src="<?php print nkf_base_image_url($row['field_base_image']['#path'],'small'); ?>"
            class="centered display--block"
            title="<?php print $row['field_base_image']['#title']; ?>"
            alt="<?php print $row['field_base_image']['#alt']; ?>"/>
        <?php if(isset($row['field_base_link'])): ?>
        </a>
      <?php endif;?>
    </div>

  <?php endif; ?>
  <?php if(isset($row['field_vip_name']) || isset($row['field_vip_description'])): ?>
    <div class="">
      <div class="bold"><?php print $row['field_vip_name']; ?></div>
      <div class=""><?php print $row['field_vip_description']; ?></div>
    </div>
  <?php endif;?>
</div>
