<?php

/**
 * @file
 * Top navigation template.
 *
 * Available variables:
 */
?>
<header class="width--100 position--fixed z-index--100 padding-lef">
  <nav class="js--scroll--200 nav__secondary container grid hide animate animate--fade-in">
    <div class="nav__secondary--menu grid-cell width--10 padding-y--sm padding-right--sm">
      <a data-toggle="class" data-target=".sub-nav--menu,.menu--toggle" data-class="hide" href="#">
        <i class="icon-menu menu--toggle"></i>
        <i class="icon-cancel menu--toggle hide"></i>
      </a>
    </div>
    <div class="nav__secondary--crumbs grid-cell width--70 padding--sm text-align--center">
      <div class="md--show">
        <?php if ($breadcrumb): ?>
          <?php print $breadcrumb; ?>
        <?php endif; ?>
      </div>
    </div>
    <div class="nav__secondary--ctas grid-cell width--20 text-align--right">
      <!-- Page actions ?  -->
    </div>
  </nav>
  <nav class="js--scroll--200 nav__main container grid">
    <!-- Logo -->
    <div class="nav__main--logo grid-cell width--33  padding-top--sm">
      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" class="display--inline-block" id="logo" title="<?php print t('Home'); ?>" rel="home"></a>
      <?php endif; ?>
    </div>

    <!-- Menu -->
    <div class="nav__main--menu grid-cell width--66 text-align--right caps">
      <div class="display--table float--right">
        <a data-toggle="class" data-target=".sub-nav--menu,.menu--toggle" data-class="hide" href="#" class="display--table-cell padding-y--xl padding--lg truncate border-left border-right">
          <i class="icon-menu menu--toggle"></i>
          <i class="icon-cancel menu--toggle hide"></i>
          <span class="">Menu</span>
        </a>
        <a data-toggle="class" data-target=".sub-nav--search,.search--toggle" data-class="hide" href="#" class="display--table-cell padding-y--xl padding--lg truncate border-right">
          <i class="icon-search search--toggle"></i>
          <i class="icon-cancel search--toggle hide"></i>
          <span class="">Search</span>
        </a>
        <a href="#" class="display--table-cell padding-y--xl padding--lg truncate border-right font-weight--800">Support the NKF
          <!-- CTA -->
        </a>
      </div>
    </div>
  </nav>
  <!-- Hidden menu -->
  <div class="sub-nav--menu hide animate ">
    <div class="container grid--center padding--md">
      <div class="grid-cell width--100">
        <div class="grid">
          <div class="grid-cell width--20">
            <h4>Prevention</h4>
          </div>
          <div class="grid-cell width--20"></div>
          <div class="grid-cell width--20"></div>
          <div class="grid-cell width--20"></div>
          <div class="grid-cell width--20"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="sub-nav--search hide">
    <div class="container grid--center padding--md">
      <div class="grid-cell width--50 margin-top--xxl margin-x--lg bg--white">
        <input placeholder="" class="padding-y--md padding-x--lg width--90 border-width--none vertical-align--bottom"/><a href="#" class="bg--white width--10 display--inline-block text-align--right"><i class="icon-search color--black font-size--xl"></i></a>
      </div>
      <div class="grid-cell width--50 margin-y--xxl margin-x--lg">
        <div class="grid">
          <div class="grid-cell width--50">
            <div class="font-style--italic">Common Search Terms</div>
            <div class="color--white padding-top--xs display--block">GFR Calculator</div>
            <div class="color--white padding-top--xs display--block">Risk factors for kidney disease</div>
          </div>
          <div class="grid-cell width--50">
            <div class="font-style--italic">Popular Pages</div>
            <div class="color--white padding-top--xs display--block">GFR Calculator</div>
            <div class="color--white padding-top--xs display--block">Risk factors for kidney</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
