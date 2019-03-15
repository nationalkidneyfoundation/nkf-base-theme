<?php
  /*
   * @file
   * Template for a banner promo within the body of a page. This banner does not bleed over the
   * edges of the page, but has rounded borders and media floated.
   *
   * Variables:
   * - $title: Optional title.
   * - $subtitle: Optional subtitle
   * - $body: Text about the promotion
   * - $ctas: A call to action related to the promo.
   * - $media: Image or video, always right aligned.
	 * 		   			<?php print nkf_base_style_image($image,'scale', 1000, 375, 'display--block center');?>

   */
?>
<div class="<?php print $inner_color;?> rounded">
	<div class="sm--display--flex flex-wrap--wrap align-items--center">
	  <div class="padding-x--xl sm--padding-x--xxxl padding-y--md width--100 sm--width--50">

		  <?php print theme( 'nkf_base_section_sm_header', array( 'smheader'=>$title)); ?>

	    <div class="width--100">
	      <?php print theme( 'nkf_base_section_body', array( 'body'=>$body)); ?>
			</div>
      <?php if (!empty($ctas)): ?>
	      <div class="padding-y--md">
	        <?php foreach($ctas as $i=>$cta): ?>
	          <a class="margin-right--xs margin-top--xs <?php print $cta['button'] ?>" href="<?php print $cta['url']; ?>">
	          	<?php print $cta[ 'title'];?>
	          </a>
	        <?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

			<?php if(isset($image)):?>
				<div class="width--100 sm--width--50 padding--xl">
					<div class="display--block display--flex">
					<?php print nkf_base_style_image($image,'scale', 500, 500, 'display--block center rounded');?>
		      </div>
				</div>
	    <?php endif; ?>

    	<?php if (!empty ($video)): ?>
				<div class="width--100 sm--width--50 padding--xl">
	    		<div class="video-wrapper display--block top bottom right width--100 rounded overflow--hidden">
	  				<?php print $video; ?>
	     		</div>
				</div>
    	<?php endif; ?>
	</div>
</div>