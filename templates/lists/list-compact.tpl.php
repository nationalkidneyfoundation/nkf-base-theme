
<div class="container display--flex flex-direction--column max-width--xxl">


    <?php if(!empty($image)): ?>
      <div>
        <?php print nkf_base_style_image($image, 'resize', 800, 500, 'display--block rounded');?>
      </div>
    <?php endif; ?>
    <?php print theme( 'nkf_base_section_sm_header', array( 'smheader'=>$title)); ?>

    <?php if (!empty($body)):?>
      <div class="padding-bottom--md">
        <?php print $body;?>
      </div>
    <?php endif;?>
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
