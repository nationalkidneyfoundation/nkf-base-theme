<div class="border-width--none border-top-width--sm border-color--gray-4 border-style--solid">
    <?php print theme('nkf_base_section_header', array('header' => $header)); ?>
    <?php print theme('nkf_base_section_subheader', array('subheader' => $subheader)); ?>
  </div>
<div class="padding-top--md display--flex flex-direction--row flex-wrap--wrap justify-content--center align-items--stretch">
<?php foreach($items as $i => $item): ?>
    <?php print $item ?>
  <?php endforeach; ?>
  
  <?php if(!empty($more)): ?>
  <div class="linkHighlight">
      <?php print $more;?>
    </div>
  <?php endif; ?>
  </div>