<?php
/**Testimonials go here
 * Will need
 * $image
 * $body
 * $name
 * $city
 *
 */
?>
<div class="display--flex flex-wrap--nowrap margin-y--sm padding-top--sm border-bottom border-top <?php print $classes; ?>" <?php print $attributes; ?>>
    <?php if (!empty ($image)): ?>
      <div class="flex-shrink--0 padding-right--xl">
          <?php print $image; ?>
       </div>
    <?php endif; ?>

    <div class="flex-shrink--0 width--5 align-items--flex-start margin-right--xs">
        <img src="/<?php print NKF_BASE_PATH . '/img/Quote.svg';?>">
    </div>

    <div class="font-style--italic margin-bottom--sm">
        <?php print $body; ?>
        <?php if (!empty ($name)): ?>
            <div class="font-style--normal bold">
                <?php print $name; ?>
                <?php if(!empty($city)): ?> 
                &bull;
                    <?php print $city; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>









