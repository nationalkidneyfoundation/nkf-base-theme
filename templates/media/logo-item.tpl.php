<?php if (!empty($logo)): ?>
    <?php print nkf_base_style_image($logo, 'scale', 150, 150, 'display--block max-width--100 width--100');?>
<?php else: ?>
    <?php print $text_logo;?>
<?php endif; ?>

