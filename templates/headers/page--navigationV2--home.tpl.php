<?php

/**
 * @file
 * Top navigation template.
 *
 * Available variables:
 */
?>
<header class="width--100 bg--orange text-align--center">
  <div class="container">
    <div class="grid width--100 padding-x--md padding-y--xxl">
      <div class="grid-cell width--25 md--display--inline-block display--none"></div>
      <div class="grid-cell md--width--50 width--100">
        <a id="logo" href="/<?php print $home; ?>" class="<?php print $home; ?> background-position--center text-align--center"></a>
      </div>
      <div class="grid-cell width--25 md--display--inline-block display--none vertical-align--middle text-align--right padding-right--lg padding-top--xxl font-size--sm">
        <?php if (!empty($page['main_cta'])) : ?>
          <?php print render($page['main_cta']); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</header>
<?php if (!empty($page['main_cta'])) : ?>
  <div class="width--100 bg--orange md--display--none display--block text-align--center padding-y--md">
    <?php print render($page['main_cta']); ?>
  </div>
<?php endif; ?>
<?php if (!empty($page['navigation'])) : ?>
<nav class="bg--orange--l1">
  <div class="container font-size--sm text-align--center ">
    <div class="nav__navigation grid md--display--inline-block display--none width--100 color--white text-align--center center">
      <?php print render($page['navigation']); ?>
      <?php if (!empty($page['navigation_search']) || TRUE) : ?>
        <div class="grid-cell md--width--auto vertical-align--middle">
          <a href="#search-modal" class="search modal-trigger padding-x--xs caps color--white display--block">
            <button class="button--orange"><i class="icon-search"></i> <span class="caps">Search</span></button>
          </a>
        </div>
      <?php endif; ?>
    </div>
    <div class="grid md--display--none display--block ">
      <div class="position--relative grid-cell vertical-align--middle text-align--center width--50 font-size--md">
        <a href="#" class="position--relative z-index--300 display--inline-block white-space--nowrap color--white" data-toggle="class" data-target=".burger-time" data-class="hide">
          <div class="burger-time padding-y--md padding-x--sm"><i class="icon-menu"></i> <span class="caps">Menu</span></div>
          <div class="burger-time padding-y--md padding-x--sm hide bg--orange"><i class="icon-cancel"></i> <span class="caps">Menu</span></div>
        </a>
        <div class="position--absolute top left right z-index--200 margin-top--xxl">
          <div class="burger-time hide  grid-cell bg--orange max-width--xl width--100">
            <?php print render($page['navigation']); ?>
          </div>
        </div>
      </div>
      <div class="grid-cell vertical-align--middle text-align--center width--50 font-size--md">
        <a href="#search-modal" class="modal-trigger display--inline-block padding-y--md padding-x--sm color--white white-space--nowrap">
          <i class="icon-search"></i> <span class="caps">Search</span>
        </a>
      </div>
    </div>
  </div>
</nav>
<?php endif; ?>
<?php if (!empty($page['navigation_search'])) : ?>
  <div id="search-modal" class="modal padding--xl bg--white border-radius--md max-width--xxl center mfp-hide">
    <div class="center padding-y--lg">
      <div><?php print render($page['navigation_search']); ?></div>
    </div>
  </div>
<?php endif; ?>
