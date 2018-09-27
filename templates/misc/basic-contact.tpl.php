<div class="<?php print $inner_color;?> container rounded border border-width--sm border-color--gray-4 padding--md">
    <div class="width--100">
    <?php print theme( 'nkf_base_section_sm_header', array( 'smheader'=>$title)); ?>
    <?php if (!empty($tagline)): ?>
      <h4>
        <?php print $tagline;?>
      </h4>
    <?php endif;?>
    <?php if (!empty($body)): ?>
        <div class="padding-bottom--sm">
          <?php print $body;?>
        </div>
        <div class="padding-bottom--md">
          <div>
            <?php print $name;?>
          </div>
          <div>
            <?php print $phone;?>
          </div>
          <div>
            <?php print $email;?>
          </div>
        </div>
        <?php if (!empty($ctas)): ?>
          <div class="margin-y--md">
            <?php foreach($ctas as $i => $cta): ?>
              <a class="margin-x--xxxs margin-top--xs <?php print $cta['button'] ?>" href="<?php print $cta['url']; ?>"><?php print $cta['title'];?></a>
            <?php endforeach; ?>
          </div>
        <?php endif;?>
      </div>
    <?php endif;?>
    <?php if (!empty($form)): ?>
      <div class="width--100 padding-bottom--md">
        <?php print $form; ?>
      </div>
    <?php endif;?>
  </div>