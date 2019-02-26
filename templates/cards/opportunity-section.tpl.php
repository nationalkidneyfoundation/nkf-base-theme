<div class="padding-bottom--xl">
    <?php print theme('nkf_base_section_header', array('header' => $header)); ?>
    <?php print theme( 'nkf_base_section_sm_header', array( 'smheader'=>$subheader)); ?>

  <div class="padding-top--md display--flex flex-direction--row flex-wrap--wrap justify-content--space-evenly align-items--flex-start">
    <?php foreach($items as $i => $item): ?>
    <div class="display--flex width--30">
          <div class="display--flex">
          <?php print $item ?>
        </div>
      </div>
    <?php endforeach; ?>
    <?php if(!empty($more)): ?>
      <div class="padding-top--md linkHighlight">
        <?php print $more;?>
      </div>
    <?php endif; ?>  
  </div>
</div>

