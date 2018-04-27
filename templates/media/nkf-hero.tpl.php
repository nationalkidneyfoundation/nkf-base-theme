<?php
  /*
   * @file
   * Template for a hero.
   *
   * Variables:
   * - $title: Optional title.
   * - $subtitle: Optional subtitle
   * - $body: Text about the promotion
   * - $button: A call to action related to the promo.
   * - $media: Image or video, always right aligned.
   *
   *
   */
?>
<div class="margin-bottom--xl padding-y--xxl min-height--lg <?php print $classes; ?>" <?php print $attributes; ?>>
  <?php if ($title_anchor): ?>
    <a name="<?php print $title_anchor; ?>"></a>
  <?php endif; ?>
  <div class="container">
    <div class="display--flex flex-direction--row flex-wrap--wrap align-items--center">
      <div class="width--100 md--width--40 padding-x--md sm--padding--xl">
        <?php if (!empty($title)): ?>
          <div class="h3 font-size--xxl bold padding-bottom--lg">
            <?php print $title;?>
          </div>
        <?php endif;?>
        <?php if (!empty($body)): ?>
          <div class="body sm--padding-right--xl padding-bottom--lg">
            <?php print $body;?>
          </div>
        <?php endif;?>
        <?php if (!empty($ctas)): ?>
          <div class="padding-y--md">
            <?php foreach($ctas as $i => $cta): ?>
              <a class="margin-right--xs margin-top--xs <?php print $cta['button'] ?>" href="<?php print $cta['url']; ?>"><?php print $cta['title'];?></a>
            <?php endforeach; ?>
          </div>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
