<?php
  /*
   * @file
   * Template for summary text.
   *
   * Variables:
   * - $title: Optional title.
   * - $media: Image or video
   */
?>

<?php print theme( 'nkf_base_section_sm_header', array( 'smheader'=>$title)); ?>
<div class="center max-width--xxxl">
  <?php if (isset($image)):?>
    <?php print $image;?>
  <?php endif; ?>

  <?php if (!empty ($video)): ?>
    <div class="video-wrapper">
  		<?php print $video; ?>
    </div>
    <?php endif; ?>
      <?php print theme('nkf_base_section_caption', array('caption' => $caption)); ?> 
</div>
