<?php

/**
 * @file
 * Top navigation template for non-home pages.
 *
 * Available variables:
 * $ia: Array of navigation items with 'name' and 'path' variables
 */
?>
<header class="display--flex flex-direction--row align-items--center justify-content--space-between width--100 border-bottom bg--white">
  <div class="display--flex position--relative align-items--center padding--md">
    <div class="sm--show">
      <a href="/" class="display--block">
        <img class="display--block" style="height: 60px;" src="/<?php print NKF_BASE_PATH;?>/img/NKF-logoR_Hori_OB.png">
      </a>
    </div>
    <div class="sm--hide">
      <a href="/" class="display--block">
        <img class="display--block" style="height: 60px;" src="/<?php print NKF_BASE_PATH;?>/img/logo__bean--orange.png">
      </a>
    </div>
  </div>
  <div class="display--flex align-items--center">
    <div class="search">
      <a href="#" class="padding-y--lg padding-x--sm caps">
        <i class="icon-search font-size--lg md--font-size--md"></i> <span class="md--display--inline display--none">Search</span>
      </a>
    </div>
    <div class="search position--relative">
      <a href="#" class="nav padding-y--lg padding-x--sm caps"
      data-toggle="class" data-target=".burger-time|.nav|.nav" data-class="hide|bg--aqua|color--white">
        <i class="burger-time icon-menu font-size--lg md--font-size--md"></i>
        <i class="burger-time icon-cancel hide font-size--lg md--font-size--md"></i>
        <span class="md--display--inline display--none">Menu</span>
      </a>

    </div>
    <div id="promotion--button"
         data-promo="button"
         class="promotion flex-align--right padding--sm display--relative"
         style="width:130px">
      <div class="display--absolute button opacity--10 bg--black animate--shimmer padding-y--md" style="width:100px"></div>
    </div>

  </div>
  <nav class="burger-time hide position--absolute right top--sm z-index--400
              bg--aqua padding-y--md sm--width--lg width--100 margin-top--xxl sm--margin-right--md">
    <?php foreach($ia as $item): ?>
      <a href="<?php print $item['path'];?>"
         class="display--block width--100 padding-x--md padding-y--sm caps bg--aqua color--white">
        <?php print $item['name'];?>
      </a>
    <?php endforeach;?>
  </nav>

</header>
