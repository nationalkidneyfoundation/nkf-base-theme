<?php

/**
 * @file
 * Top navigation template.
 *
 * Available variables:
 */
?>
<header class="print--hide width--100 bg--<?php print $header_color;?> color--white ">
  <nav class="container position--relative">
    <div class="display--table width--100">
      <div class="display--table-cell width--100 vertical-align--middle padding-left--md">
        <a href="/" id="logo" class="display--inline-block vertical-align--middle padding-x--md">
        </a>
      </div>
      <div class="display--table-cell vertical-align--middle width--auto">
        <a href="#" class="display--block white-space--nowrap color--white" data-toggle="class" data-target=".burger-time" data-class="hide">
          <div class="burger-time md--padding-y--xl padding-y--lg padding-x--xs">
            <div class="md--show">
              <i class="icon-menu"></i>
              <span class="caps">Menu</span>
            </div>
            <div class="md--hide font-size--lg padding-x--xxs">
              <i class="icon-menu"></i>
            </div>
          </div>
          <div class="burger-time hide bg--<?php print $header_color;?>--l1 md--padding-y--xl padding-y--lg padding-x--xs">
            <div class="md--show">
              <i class="icon-cancel"></i>
              <span class="caps">Menu</span>
            </div>
            <div class="md--hide font-size--lg padding-x--xxs">
              <i class="icon-cancel"></i>
            </div>
          </div>
        </a>
      </div>
      <?php if (!empty($page['navigation_search'])) : ?>
        <div class="display--table-cell vertical-align--middle width--auto">
          <a href="#search-modal" class="modal-trigger display--block md--padding-y--xl padding-y--lg padding-x--xs white-space--nowrap color--white">
            <div class="md--show">
              <i class="icon-search"></i>
              <span class="caps">Search</span>
            </div>
            <div class="md--hide font-size--lg padding-right--xxs">
              <i class="icon-search"></i>
            </div>
          </a>
        </div>
        <div id="search-modal" class="modal padding--xl bg--white border-radius--md max-width--xxl center mfp-hide">
          <div class="center padding-y--lg">
            <div><?php print render($page['navigation_search']); ?></div>
          </div>
        </div>
      <?php endif; ?>

        <?php if (!empty($page['main_cta'])) : ?>
          <div class="display--table-cell vertical-align--middle width--auto padding-x--xs">
            <?php print render($page['main_cta']); ?>
          </div>
        <?php endif; ?>
    </div>
    <div class="position--absolute right z-index--200">
      <div class="burger-time hide font-size--md grid-cell bg--<?php print $header_color;?>--l1 max-width--xl width--100">
        <?php print render($page['navigation']); ?>
      </div>
    </div>
  </nav>
</header>
