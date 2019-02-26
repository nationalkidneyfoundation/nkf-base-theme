<?php 
/*
            <?php print nkf_base_style_image($image,'', FALSE, FALSE, 'display--block center rounded align-self--center');?>

/*<img src="<?php print $image;?>" alt="" style="display: block; margin: 0 auto; height: auto; max-height: 700px; max-width: 1000px; width: 100%; align-self: center;">*/

?>

<div class="bg--gray-1">
    <div class="position--relative display--flex flex-wrap--wrap md--flex-wrap--nowrap min-height--xl align-items--center">
        <div class="width--100 md--width--50 padding-y--xxl padding-x--md sm--padding-right--lg linkHighlight">
                <div class="sm--padding-bottom--lg">
                    <div class="font-size--xxl font-weight--400 padding-bottom--sm">
                        <?php print $title;?>
                    </div>
                    <div class="padding-bottom--sm">
	                    <?php print theme( 'nkf_base_section_body', array( 'body'=>$body)); ?>
                    </div>
                    <div><?php print $more;?></div>
                </div>
            </div>
        <div class="sm--position--absolute top bottom right width--100 sm--width--50 display--flex">
            <?php print nkf_base_style_image($image,'', FALSE, FALSE, 'display--block center rounded align-self--center');?>
        </div>
    </div>
</div>