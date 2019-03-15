<div class="padding-bottom--xl">
    <?php print theme('nkf_base_section_header', array('header' => $header)); ?>
    <?php print theme( 'nkf_base_section_sm_header', array( 'smheader'=>$subheader)); ?>

<div class="padding-top--md display--flex flex-direction--row flex-wrap--wrap justify-content--center align-items--stretch">
  <?php foreach($items as $i => $item): ?>
  <div class="display--flex margin--xs" style="flex: 0 0 150px;">
        <div class="border rounded display--flex align-items--center overflow--hidden padding--sm min-height--md bold">
        <?php print $item ?>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
  <?php if(!empty($more)): ?>
    <div class="text-align--center padding-top--md linkHighlight">
      <?php print $more;?>
    </div>
  <?php endif; ?>
</div>
