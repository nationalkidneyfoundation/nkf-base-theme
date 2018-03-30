<?php
  /*
   * @file
   * Template for 50 x 50 layout.
   *
   * Variables:
   * - $bg_color: background color class.
   * - $left: .
   * - $right:
   *
   */
?>

<div class="<?php print $bg_color; ?> padding-x--md md--padding-x--xxxl padding-y--xl">
  <div class="container">
    <div class="display--flex flex-direction--row flex-wrap--wrap align-items--center">
      <div class="width--100 md--width--50 padding--xl">
        <?php print $left;?>
      </div>

      <div class="width--100 md--width--50 padding--xl">
        <?php print $right;?>
      </div>
    </div>
  </div>
</div>
