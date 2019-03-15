<div class="padding-bottom--xl">
  <div class="">
    <?php print theme('nkf_base_section_header', array('header' => $title)); ?>
    <?php print theme('nkf_base_section_subheader', array('subheader' => $body)); ?>
  </div>
  <?php if(!empty($more)): ?>
    <div class="linkHighlight top--sm right padding-top--lg padding-x--md order--2">
      <?php print $more;?>
    </div>
  <?php endif; ?>
</div>
<div class="display--flex flex-wrap--wrap">
  <?php foreach($items as $item): ?>
    <div class="padding-bottom--xl sm--padding-right--xl <?php print $width; ?>">
      <?php print $item ?>
    </div>
  <?php endforeach;?>
</div>
