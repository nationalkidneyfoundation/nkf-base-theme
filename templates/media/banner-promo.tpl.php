<?php
  /*
   * @file
   * Template for a banner promo.
   *
   * Variables:
   * - $title: Optional title.
   * - $subtitle: Optional subtitle
   * - $body: Text about the promotion
   * - $ctas: A call to action related to the promo.
   * - $media: Image or video, always right aligned.
   *
	 *     <?php if (!empty ($image)): ?>
       	<div class="display--block top bottom right width--100">
          <img src="<?php print $img_src;?>" style="display: block; margin: 0 auto; height: auto; max-height: 700px; max-width: 1000px; width: 100%; align-self: center;"/>
        </div>
      <?php endif; ?>
   *
   */

?>
<div class="edge--wavy--bottom">
	<div class="container md--display--flex flex-wrap--wrap align-items--center">
	  <div class="align-self--flex-start padding-top--lg padding-x--md padding-y--xxxl width--100 md--width--40 md--padding-right--xxxl">

		<?php if (!empty($title)): ?>
      	<h1 class="highlight display--inline padding-top--xl font-size--xxl md--font-size--xxxl">
          <?php print $title;?>
        </h1>
	    <?php endif;?>
	    <div class="width--100 font-size--lg margin-top--lg">
	      <?php print $body; ?>
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
				<div class="width--100 md--width--60 padding-x--md md--padding-y--xxl  md--padding-left--xxl">
					<div class="display--block">
		        <?php print nkf_base_style_image($image,'resize', 1000, 545, 'display--block center rounded');?>
		      </div>
				</div>
	    <?php endif; ?>

    	<?php if (!empty ($video)): ?>
				<div class="width--100 md--width--60 padding-x--md md--padding-y--xxl md--padding-left--xxl">
	    		<div class="video-wrapper display--block top bottom right width--100 rounded overflow--hidden"><?php print $video; ?></div>
				</div>
    	<?php endif; ?>
	</div>
</div>
