
<?php nkf_base_get_node_related_content($node);?>
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

  <?php if(!empty($toc = nkf_base_get_toc($node))):?>
    <div class="center prose
                padding-x--md md--padding-x--xxxl
                margin-bottom--lg">
      <h3 class="">Page contents</h3>
      <?php print $toc; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($content)): ?>
    <div<?php print $content_attributes ?>>
      <?php print render($content) ?>
    </div>
  <?php endif; ?>
  <?php if(!empty($meta_info['filed_in']) || !empty($meta_info['related_content'])): ?>
    <div class="bg--gray-1 margin-top--xl padding-x--md border-top">
      <div class="container display--flex flex-wrap--wrap">
        <?php if (!empty($meta_info['filed_in'])): ?>
          <div class="width--100 md--width--30 md--padding-right--xl padding-y--xl border-right">
            <h3>Explore related categories</h3>
            <ul class="list-style--dash padding-left--lg margin--none">
              <?php foreach($meta_info['filed_in'] as $filed_in): ?>
                <li class="padding-bottom--sm"><?php print $filed_in;?></li>
              <?php endforeach;?>
            </ul>
          </div>
        <?php endif; ?>
        <?php if (!empty($related_content)): ?>
          <div class="width--100 md--width--70 md--padding-left--xl padding-y--xl ">
            <h3>Read related content</h3>
            <ul class="list--reset display--flex flex-wrap--wrap  margin--none">
              <?php foreach($related_content as $content): ?>
                <li class="width--100 md--width--50 padding-right--md"><?php print $content;?></li>
              <?php endforeach;?>
            </ul>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php if (!empty($post_object)) print render($post_object) ?>
