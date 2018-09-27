<?php if (!empty($logo)): ?>
    <div class="display--flex margin--xs" style="flex: 0 0 150px;">
        <div class="border border-width--sm border-color--gray-4 rounded display--flex align-items--center overflow--hidden padding--sm min-height--md">
            <?php print $logo;?>
        </div>
    </div>
<?php else: ?>
    <div class="display--flex margin--xs" style="flex: 0 0 150px;">
        <div class="border border-width--sm border-color--gray-4 rounded display--flex align-items--center overflow--hidden padding--sm min-height--md">
            <div class="bold display--block max-width--100 width--100"><?php print $text_logo;?></div>
        </div>
    </div>
<?php endif; ?>
