<?php
/**
 * Returns the HTML a Title and Media hero.
 * Can be used for events or an overview/landing page.
 *
 * Available Variables
 * - $left_content
 * - $right_content
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
  <?php if (isset($anchor_id)) :?>
    <a id="" class="nav-anchor"></a>
  <?php endif;?>
  <div class="md--display--table width--100">
    <div class="md--display--table-cell
                md--width--50
                width--100
                vertical-align--middle
                text-align--left
                <?php print $bg_color_left; ?>">
      <div class="container--50 display--inline-block width--100 text-align--center">
        <div class="padding-x--lg padding-y--xl">
          <?php print $left_content;?>
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
        <div class="padding-x--lg padding-y--xl">
          <?php print $right_content;?>
        </div>
      </div>
    </div>
  </div>
</section>
