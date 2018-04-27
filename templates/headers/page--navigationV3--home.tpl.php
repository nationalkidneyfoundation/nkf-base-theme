<?php

/**
 * @file
 * Top navigation template.
 *
 * Available variables:
 * $ia: Array of navigation items with 'name' and 'path' variables
 */
?>
<header class="display--flex flex-direction--row align-items--center width--100 padding--xl border-bottom">
  <div class="lg--show">
    <a href="/">
      <img class="width--md min-width--md padding--lg " src="/<?php print NKF_BASE_PATH;?>/dev/img/logos/vertical/NKF-logoR_Vert_OB.png" />
    </a>
  </div>
  <div class="flex-grow--1">
    <div class="clearfix lg--show">
      <div class="display--flex pill align-items--center float--right width--xl border padding--xxxs">
        <span class="color--gray-3 flex-grow--1 padding-left--sm caps font-size--sm">Search by keyword</span>
        <button class="button--gray-2 float--right padding-y--xxs">search</button>
      </div>
    </div>
    <div class="lg--hide">
      <a href="/">
        <img class="padding--lg " src="/<?php print NKF_BASE_PATH;?>/img/NKF-logoR_Hori_OB.png" />
      </a>
    </div>
    <nav class="container
      display--flex flex-direction--row flex-wrap--wrap lg--flex-wrap--nowrap align-items--center
      padding-left--md lg--padding-top--xxxl
      lg--font-size--sm xl--font-size--md lg--text-align--center">
      <?php foreach($ia as $item): ?>
        <a href="<?php print $item['path'];?>"
           class="display--block sm--width--50 width--100 padding--sm caps">
          <?php print $item['name'];?>
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
