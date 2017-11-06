<?php
/**
 * Returns the HTML a Title and Media hero.
 * Can be used for events or an overview/landing page.
 *
 * Available Variables
 * - $title_prefix: Text before the main title.
 * - $title: Main subject of the hero.
 * - $title_suffix: E.g. tagline.
 * - $description: Additional information.
 * - $ctas: Array of links.
 * - $media: HTML for media, e.g image, video, etc.
 * - $anchor_id: If this section has an anchor.
 * - $bg_color_left: .
 * - $bg_color_right: .
 * - $section_classes: .
 */
 // make sure we have some value for these.
 $bg_color_left = !empty($bg_color_left) ? $bg_color_left : '';
 $bg_color_right = !empty($bg_color_right) ? $bg_color_right : '';
?>

<section class="nav-section width--100 grid-cell <?php print $section_classes;?>">
  <a id="home" class="nav-anchor"></a>
  <div class="md--display--table width--100">
    <div class="md--display--table-cell
                md--width--50
                width--100
                vertical-align--middle
                text-align--left
                <?php print $bg_color_left; ?>">
      <div class="container--50 display--inline-block width--100 text-align--center">
        <div class="padding-x--lg padding-y--xl">
          <?php if (isset($title_prefix)): ?>
            <div class="caps bold">
              <?php print render($title_prefix); ?>
            </div>
          <?php endif; ?>
          <h1 class="md--font-size--xxxxl font-size--xxxl padding-y--none lg--padding-x--lg line-height--110">
            <?php print render($title); ?>
          </h1>
          <?php if (isset($title_suffix)): ?>
            <div class="padding-top--md caps font-size--lg">
              <?php print render($title_suffix); ?>
            </div>
          <?php endif; ?>
          <?php if (isset($description)): ?>
            <div class="padding-top--lg">
              <?php print render($description); ?>
            </div>
          <?php endif; ?>
          <div class="padding-top--lg md--padding-top--xxl font-size--s">
            <?php foreach($ctas as $i => $cta): ?>
              <?php print render($cta); ?>
            <?php endforeach;?>
          </div>
        </div>
      </div>
    </div>
    <div class="md--display--table-cell
                md--width--50
                width--100
                vertical-align--middle
                text-align--left
                <?php print $bg_color_right;?>">
      <div class="container--50 display--inline-block width--100 text-align--center">
        <?php print $media; ?>
      </
      div>
    </div>
  </div>
</section>
