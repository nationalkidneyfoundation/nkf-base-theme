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
<section class="display--flex align-items--center min-height--xl position--relative">
  <div class="<?php print $hero_class;?> position--absolute z-index--200 top bottom width--100"></div>
  <?php if (!empty($hero_image)): ?>
    <div data-images="<?php print $hero_images;?>"
         class="js--image-rotate position--absolute z-index--100 top bottom width--100 background-size--cover background-position--center"
         style="background-image:url(<?php print $hero_image;?>)">
    </div>
  <?php endif;?>
  <div class="<?php print $text_color;?> width--100 position--relative z-index--300 margin-bottom--xl padding-y--xxl">
    <div class="text-align--center">
      <?php if (!empty($title)): ?>
        <div class=" font-size--xxl padding-y--xs caps bold">
          <?php print $title;?>
        </div>
      <?php endif;?>
      <?php if (!empty($body)): ?>
        <div class="center font-size--xl max-width--xxl">
          <?php print $body;?>
        </div>
      <?php endif;?>
      <?php if (!empty($ctas)): ?>
        <div class="padding-y--md">
          <?php foreach($ctas as $i => $cta): ?>
            <a class="margin-x--xxxs margin-top--xs <?php print $cta['button'] ?>" href="<?php print $cta['url']; ?>"><?php print $cta['title'];?></a>
          <?php endforeach; ?>
        </div>
      <?php endif;?>
    </div>
  </div>
</section>
