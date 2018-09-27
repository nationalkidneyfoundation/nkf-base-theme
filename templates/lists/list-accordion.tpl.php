
<?php print theme( 'nkf_base_section_sm_header', array( 'smheader'=>$title)); ?>
<div class="border border-color--gray-3 rounded">
  <?php foreach($items as $i => $item): ?>
    <div class="test">
      <?php if ($i > 0): ?>
      <div class="border-top border-top border-color--gray-3"></div>
    <?php endif; ?>
    <?php print $item ?>
</div>
  <?php endforeach; ?>
</div>
