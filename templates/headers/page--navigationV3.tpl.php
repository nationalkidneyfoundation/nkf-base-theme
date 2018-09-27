<?php

/**
 * @file
 * Top navigation template for non-home pages.
 *
 * Available variables:
 * $ia: Array of navigation items with 'name' and 'path' variables
 */
?>
<header class="print--hide display--flex flex-direction--row align-items--center justify-content--space-between width--100 border-bottom bg--white">
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
      <a href="#" class="novisit padding-y--lg padding-x--sm caps color--gray-4 md--font-size--sm">
        <i class="icon-search"></i> <span class="md--display--inline display--none">Search</span>
      </a>
    </div>
    <div class="search position--relative">
      <a href="#" class="nav novisit padding-y--lg padding-x--sm caps color--gray-4 md--font-size--sm"
      data-toggle="class" data-target=".burger-time|.nav" data-class="hide|bg--gray-1">
        <i class="burger-time icon-menu "></i>
        <i class="burger-time icon-cancel hide "></i>
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
              bg--gray-1 padding-y--sm sm--width--lg width--100 margin-top--xxl sm--margin-right--md">
    <?php foreach($ia as $item): ?>
      <a href="<?php print $item['path'];?>"
         class="novisit display--block width--100 padding-x--md padding-y--xs caps color--gray-4 md--font-size--sm">
        <?php print $item['name'];?>
      </a>
    <?php endforeach;?>
  </nav>

</header>