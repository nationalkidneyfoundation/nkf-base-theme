<div class="display--flex flex-wrap--wrap align-items--center justify-content--space-between max-width--xxxl center ">
   <div class="max-width--xl md--padding-x--md padding-bottom--sm">
     <?php print theme('nkf_base_section_sm_header', array( 'smheader'=>$title)); ?>
     <?php if(!empty($description)): ?>
       <?php print $description; ?>
     <?php endif; ?>
   </div>
   <div class="max-width--xl md--padding-x--md padding-bottom--sm">
    <?php print $form; ?>
  </div>
</div>
