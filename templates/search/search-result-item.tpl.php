<article class="padding-bottom--xl prose">

  <h3 class="padding-bottom--xxs">
    <a href="<?php print $path; ?>" class="display--block"><?php print $title; ?></a>
  </h3>
  <?php if(!empty($filed_in)): ?>
    <div class="padding-bottom--xxs font-size--sm">
      <span class="">Filed in: </span>
      <span><?php print implode($filed_in, ' | ');?></span>
    </div>
  <?php endif; ?>
  <div class="display--flex flex-wrap--nowrap">
    <?php if(!empty($teaser) || !empty($toc)): ?>
      <div class="">
        <?php if(!empty($teaser)): ?>
          <?php print $teaser;?>
        <?php endif; ?>
        <?php if(!empty($toc)): ?>
          <?php print theme('nkf_base_toc_inline', $toc); ?>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <?php if(!empty($image)): ?>
      <div class="hide margin-left--lg flex-shrink--0 overflow--hidden">
        <?php print nkf_base_style_image($image, 'resize', 130, 130, 'display--block rounded'); ?>
      </div>
    <?php endif; ?>
  </div>

</article>
