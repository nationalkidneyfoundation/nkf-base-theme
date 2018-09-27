
<?php if (!empty($pre_object)) print render($pre_object) ?>

<div<?php print ($attributes) ?>>

  <?php if (!empty($title_prefix)) print render($title_prefix); ?>

  <?php if (!$page && !empty($title)): ?>
    <h2 <?php if (!empty($title_attributes)) print $title_attributes ?>>
      <?php if (!empty($new)): ?><span class="new"><?php print $new ?></span><?php endif; ?>
      <a href="<?php print $node_url ?>"><?php print $title ?></a>
    </h2>
  <?php endif; ?>

  <?php if (!empty($title_suffix)) print render($title_suffix); ?>

  <?php if (!empty($submitted)): ?>
    <div class="<?php print $hook ?>-submitted clearfix"><?php print $submitted ?></div>
  <?php endif; ?>

  <?php if(!empty($toc)):?>
    <div class="center prose
                padding-x--md md--padding-x--xxxl
                margin-bottom--lg">
      <h3 class="">Page contents</h3>
      <?php print theme('nkf_base_toc', $toc); ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($content)): ?>
    <div<?php print $content_attributes ?>>
      <?php print render($content) ?>
    </div>
  <?php endif; ?>
  <?php if(!$is_landing_page && (!empty($meta_info['filed_in']) || !empty($meta_info['related_content']))): ?>
    <div class="padding-y--xxxl border-top margin-top--xxxl">
      <div class="container display--flex flex-wrap--wrap padding-x--md">
        <?php if (!empty($related_content)): ?>
          <div class="">
            <?php print theme('nkf_base_section_header', array('header' => 'Read related content')); ?>
            <ul class="list--reset display--flex flex-wrap--wrap  margin--none">
              <?php foreach($related_content as $content): ?>
                <li class="width--100 md--width--33 padding-right--xxl padding-bottom--xl">
                  <?php print $content;?>
                </li>
              <?php endforeach;?>
            </ul>
          </div>
        <?php endif; ?>
        <?php if (!empty($meta_info['filed_in']) && false): ?>
          <div class="mutelink width--100 md--width--25 md--padding-left--xl padding-y--xl border-left">
            <h2>Explore related categories</h2>
            <ul class="list-style--dash padding-left--lg margin--none">
              <?php foreach($meta_info['filed_in'] as $filed_in): ?>
                <li class="padding-bottom--sm"><?php print $filed_in;?></li>
              <?php endforeach;?>
            </ul>
          </div>
        <?php endif; ?>

      </div>
    </div>
  <?php endif; ?>
</div>

<?php if (!empty($post_object)) print render($post_object) ?>
