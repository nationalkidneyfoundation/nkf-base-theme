<?php
/**Testimonials go here
 * Will need
 * $image
 * $body
 * $name
 * $city
 *
 *
 */
?>
<div class="display--flex flex-direction--column margin-y--sm">
	<?php if (!empty ($image)): ?>
		<div class="flex-shrink--0 padding-right--xl">
			<?php print $image; ?>
		</div>
	<?php endif; ?>
	<div style="top:22px;" class="position--relative border-top border-top-width--sm border-color--gray-4 text-align--center align-items--flex-start margin-right--xs">
		<img class="position--relative bg--white padding--xs" style="width:50px; top:-22px;" src="/<?php print NKF_BASE_PATH . '/img/Quote.svg';?>">
	</div>
	<div class="font-style--italic margin-bottom--sm font-size--lg">
		<?php print $body; ?>
		<?php if (!empty ($name)): ?>
		<div class="font-style--normal bold caps padding-top--sm font-size--md">
			<?php print $name; ?>
			<?php if(!empty($city)): ?>&bull;
			<?php print $city; ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</div>
