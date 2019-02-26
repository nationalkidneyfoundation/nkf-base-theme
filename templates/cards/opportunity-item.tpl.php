<div class="max-width--xxxl center position--relative linkHighlight">
    <?php if(isset($image)):?>
        <?php print $image;?>
    <?php endif;?>
    <?php if (isset($op_type)):?>
        <div class="caps margin-top--xs"><?php print $op_type;?></div>
    <?php endif;?>
        <h3><?php print $headline;?></h3>
        <div class="color--orange caps"><?php print $location;?></div>
        <div><?php print $body;?></div>
    <div class="margin-top--xs">
        <?php if(isset($more)):?>
          <?php print $more;?>
        <?php endif;?>
    </div>
</div>