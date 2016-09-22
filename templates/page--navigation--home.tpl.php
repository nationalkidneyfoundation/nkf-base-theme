<?php

/**
 * @file
 * Top navigation template.
 *
 * Available variables:
 */
?>
<header class="width--100 bg--<?php print $bg_color; ?> <?php print $text_color; ?> text-align--center">
  <div class="container">
    <div class="grid width--100 padding-x--md padding-y--xxl">
      <div class="grid-cell width--25"></div>
      <a href="#" class="grid-cell width--50 vertical-align--middle  text-align--center">
        <img class="display--inline-block width--xl" src="<?php print $logo; ?>"/>
      </a>
      <div class="grid-cell width--25  vertical-align--middle text-align--right">
        <?php if ($cta): ?>
          <a href="#" class="button--<?php print $cta_color; ?> caps font-size--sm"><?php print $cta; ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<div class=" font-size--sm width--100 bg--{{bg-color}}--l1 text-align--center center ">
  <div class="display--table color--white text-align--center center">
    {% for item in menu %}
    <div class="display--table-cell vertical-align--middle width--auto">
      <a href="#" class="display--inline-block padding-y--lg padding-x--sm {{text-color}}">
        <span class="caps">{{ item }}</span>
      </a>
    </div>
    {% endfor %}
    <div class="display--table-cell vertical-align--middle width--auto">
      <a href="#" class="display--inline-block padding-y--md padding-x--sm color--white white-space--nowrap">
        <button class="button button--{{bg-color}}"><i class="icon-search"></i> <span class="caps">Search</span></button>
      </a>
    </div>
  </div>
</header>

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

</header>
