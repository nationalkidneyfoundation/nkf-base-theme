<?php

/**
 * @file
 * Top navigation template.
 *
 * Available variables:
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
    <nav class="lg--font-size--sm xl--font-size--md
      display--flex flex-direction--row flex-wrap--wrap lg--flex-wrap--nowrap align-items--center
      padding-left--md lg--padding-top--xxxl ">
      <?php foreach($ia as $item): ?>
        <a href="<?php print $item['path'];?>" class="display--block sm--width--50 width--100 padding--sm color--gray-4 caps">
          <?php print $item['name'];?>
        </a>
      <?php endforeach;?>
      <div class="padding--sm flex-align--right lg--show"><a class="button--outline--aqua">Donate</a></div>
    </nav>
  </div>

</header>
