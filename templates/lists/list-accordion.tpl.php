
<?php print theme( 'nkf_base_section_sm_header', array( 'smheader'=>$title)); ?>
<div class="<?php print $classes; ?> border border-color--gray-4 border-width--sm rounded">
  <?php foreach($items as $i => $item): ?>
    <?php if ($i > 0): ?>
      <div class="border-top border-top border-color--gray-3"></div>
    <?php endif; ?>
    <?php print $item ?>
  <?php endforeach; ?>
</div>
