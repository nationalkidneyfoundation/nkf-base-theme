
<div class="container display--flex flex-direction--column max-width--xxxl">

  <?php print theme( 'nkf_base_section_sm_header', array( 'smheader'=>$title)); ?>

    <?php if(!empty($image)): ?>
      <div class="padding-bottom--md">
        <?php print nkf_base_style_image($image, 'resize', 600, 300, 'display--block rounded');?>
      </div>
    <?php endif; ?>
    <ul class="padding-left--lg margin--none">
      <?php foreach($items as $i => $item): ?>
        <li><?php print $item ?></li>
      <?php endforeach;?>
    </ul>
    <?php if(!empty($more)): ?>
  <div class="linkHighlight">
      <?php print $more;?>
    </div>
  <?php endif; ?>

</div>
