<?php

/**
 * @file
 * Top navigation template.
 *
 * Available variables:
 * $ia: Array of navigation items with 'name' and 'path' variables
 */
?>
<header class="display--flex flex-direction--row align-items--flex-end width--100 padding--xl border-bottom">
  <div class="lg--show">
    <a href="/">
      <img class="width--md min-width--md padding-x--lg padding-top--lg padding-bottom--sm" src="/<?php print NKF_BASE_PATH;?>/dev/img/logos/vertical/NKF-logoR_Vert_OB.png" />
    </a>
  </div>
  <div class="flex-grow--1">
    <div class="clearfix lg--show">
      <div class="float--right max-width--xl">
        <?php print $search_form; ?>
      </div>
    </div>
    <div class="lg--hide">
      <a href="/">
        <img class="padding-x--lg padding-top--lg" src="/<?php print NKF_BASE_PATH;?>/img/NKF-logoR_Hori_OB.png" />
      </a>
    </div>
    <nav class="container
      display--flex flex-direction--row flex-wrap--wrap lg--flex-wrap--nowrap align-items--flex-end
      padding-left--md lg--padding-top--xxxl
      lg--font-size--sm xl--font-size--md">
      <?php foreach($ia as $item): ?>
        <a href="<?php print $item['path'];?>"
           class="mutelink display--block sm--width--50 width--100 padding--sm caps">
          <div class="md--width--90"><?php print $item['name'];?></div>
        </a>
      <?php endforeach;?>

      <div id="promotion--button"
           data-promo="button"
           class="promotion flex-align--right padding--sm display--relative"
           style="width:100px">
        <div class="display--absolute button opacity--10 bg--black animate--shimmer padding-y--md" style="width:100px"></div>
      </div>
    </nav>
  </div>

</header>
