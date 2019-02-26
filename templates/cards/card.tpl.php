<div class="linkHighlight">
    <div class="max-width--xxxl center position--relative">
    <?php if(isset($image)):?>
        <?php print $image;?>
    <?php endif;?>
    <?php if (isset($overlay_header)):?>
        <div class="bold font-size--xl sm--font-size--xxxl"><?php print $overlay_header;?></div>
    <?php endif;?>
    <?php if (isset($overlay_subheader)):?>
        <div class="font-size--lg sm--font-size--xxl"><?php print $overlay_subheader;?></div>
    <?php endif;?>
        <h3><?php print $headline;?></h3>
        <div><?php print $body;?></div>
        <?php if(isset($more)):?>
        <div class="padding-top--md"><?php print $more;?></div>
        <?php endif;?>
    </div>
</div>
