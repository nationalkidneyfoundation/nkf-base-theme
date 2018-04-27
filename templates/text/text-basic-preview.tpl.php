<?php
  /*
   * @file
   * Template for text.
   *
   * Variables:
   * - $title: Optional title.
   * - $body: Place where stuff goes.
   * - $left_media:
   * - $right_media:
   * - $left_pullquote:
   * - $right_pullquote:
   *
   */
   //dpm(get_defined_vars());
?>
<div class="test border border-width--lg border-color--gray-4 padding-x--xxxl height--md overflow-y--scroll prose margin-top--md">
  <?php if ($title): ?>
    <h3><?php print $title;?></h3>
  <?php endif;?>
  <div class="font-size--md">

    <!-- LEFT MEDIA -->
    <?php if ($left_media): ?>
      <div class="md--float--left margin-left--xxxl- md--max-width--lg md--padding-right--xxxl padding-bottom--lg">
        <?php print $left_media; ?>
      </div>
    <?php endif; ?>

    <!-- RIGHT MEDIA -->
    <?php if ($right_media): ?>
      <div class="md--float--right margin-right--xxxl- md--max-width--lg md--padding-left--xxxl padding-bottom--xs">
        <?php print $right_media; ?>
      </div>
    <?php endif; ?>

    <!-- LEFT PULL QUOTE -->
    <?php if ($left_pullquote): ?>
      <div class="md--float--left margin-left--xxxl- md--max-width--lg md--padding-right--xxxl padding-bottom--md bold font-size--lg">
        <?php print $left_pullquote; ?>
      </div>
    <?php endif; ?>

    <!-- RIGHT PULL QUOTE -->
    <?php if ($right_pullquote): ?>
      <div class="float--right margin-right--xxxl- md--max-width--lg padding-left--xxxl padding-bottom--lg bold font-size--lg">
        <?php print $right_pullquote; ?>
      </div>
    <?php endif; ?>


    <!-- BODY -->
    <?php print $body;?>

  </div>

</div>
<div class="blah prose width--100 text-align--center margin-bottom--lg">
  <a class="bg--gray-4 display--inline-block color--white padding-x--sm padding-bottom--sm" href="#" data-toggle="class" data-target=".test|.blah i" data-class="height--md|hide">
    <i class="icon-down-open "></i>
    <i class="icon-up-open hide"></i>
  </a>
</div>
