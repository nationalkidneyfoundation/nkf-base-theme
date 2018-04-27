<?php if (!empty($pre_object)) print render($pre_object) ?>

<div class="bg--gray-1" <?php print ($attributes) ?>>

<?php if (!empty($content['field_ds_status'])): ?>
  <div class="prose center padding-x--md md--padding-x--none padding-top--xxl">
    <div class="bg--white display--inline-block caps">
      <i class="display--inline-block <?php print $ds_status;?>"></i>
      <span class="padding-right--xs">
        <?php print render($content['field_ds_status']) ?>
      </span>
    </div>
  </div>
<?php endif; ?>

  <?php if (!empty($title)): ?>
    <section class="main__title padding-y--lg">
      <div class="container">
        <?php print render($title_prefix); ?>
        <h1 class="font-size--xxl padding--none">
          <div class="prose center padding-x--md md--padding-x--none">
            <?php print $title ?>
          </div>
        </h1>
        <?php print render($title_suffix); ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if (!empty($title_suffix)) print render($title_suffix); ?>

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

      <div class="padding-y--lg bg--gray-1">
        <h2 class="hide border-top prose center padding-x--md md--padding-x--none">Usage</h2>
        <div class="prose center padding-x--md md--padding-x--none font-size--lg">
          <?php print render($content['body']) ?>
        </div>
      </div>
      <div id="code" class="hide margin-top--xl padding-top--xl border-top prose center padding-x--md md--padding-x--none">
        <h2 class="">Code</h2>
        <a class="" href="#"
           data-toggle="class" data-target="#code .r" data-class="hide">
           <span class="r">view</span>
           <span class="r hide">hide</span>
        </a>
        <div class="hide r">
          <?php print render($content['field_ds_code']) ?>
        </div>
      </div>
      <div class="margin-top--xl padding-top--xl bg--white">
        <h2 class="hide border-top prose center padding-x--md md--padding-x--none">Example(s)</h2>
        <?php print render($content['field_paragraph_section']) ?>
      </div>

    </div>
  <?php endif; ?>

  <?php if (!empty($links)): ?>
    <div class="<?php print $hook ?>-links clearfix">
      <?php print render($links) ?>
    </div>
  <?php endif; ?>
</div>

<?php if (!empty($post_object)) print render($post_object) ?>
