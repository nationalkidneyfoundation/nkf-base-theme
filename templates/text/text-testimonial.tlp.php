<? php
/**Testimonials go here
 * Will need
 * $image
 * $body
 * $name
 * $city
 */
?>
<div class="prose display--flex">
    <?php if ($image): ?>
        <div class="display--flex-row border border-width--md">
        <?php print ($image); ?>
        </div>
    <?php endif;?>
    <div class="bg--red">
    <?php print ($body); ?>
    </div>
</div>