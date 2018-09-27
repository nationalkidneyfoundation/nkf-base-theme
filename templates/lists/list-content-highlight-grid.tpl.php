<div class="display--flex flex-direction--row- justify-content--space-between padding-y--lg border-width--none border-top-width--sm border-color--gray-4 border-style--solid">
  <div class="">
    <?php print theme('nkf_base_section_header', array('header' => $title)); ?>
    <?php print theme('nkf_base_section_subheader', array('subheader' => $body)); ?>
  </div>
  <?php if(!empty($more)): ?>
    <div class="hightrigger top--sm right padding-top--lg padding-x--md order--2">
      <?php print $more;?>
    </div>
  <?php endif; ?>
</div>
<div class="display--flex flex-wrap--wrap">
  <div class="md--width--50 width--100 md--padding-right--lg md--padding-bottom--none padding-bottom--xl">
    <?php print $highlighted_item ?>
  </div>
  <div class="md--width--50 width--100 md--padding-left--lg">
    <div class="display--flex flex-wrap--wrap">
      <?php foreach($items as $item): ?>
        <div class="padding-bottom--xl sm--padding-right--xl sm--width--50 width--100">
          <?php print $item ?>
        </div>
      <?php endforeach;?>
    </div>
  </div>
</div>
