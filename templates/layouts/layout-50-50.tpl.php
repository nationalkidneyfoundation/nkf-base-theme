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

<div class="margin-y--xxxl <?php print $bg_color; ?>">
  <div class="container">
    <div class="display--flex flex-direction--row flex-wrap--wrap md--align-items--baseline">
      <div class="width--100 md--width--50 md--padding--xl">
        <?php print $left;?>
      </div>

      <div class="width--100 md--width--50 md--padding--xl">
        <?php print $right;?>
      </div>
    </div>
  </div>
</div>
