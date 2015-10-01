<?php
  //print '<pre>';
  //var_dump(array_keys(get_defined_vars()));
  //print_r($_SESSION['nkf_base']['messages']);
  //print '</pre>';
?>
<div class="<?php print $page_classes; ?>">
  <header class="bg--orange header background-size--cover background-position--center">
    <div class="container padding-x--sm sm--padding-x--lg padding-y--md sm--padding-y--lg">
      <div class="grid">
        <?php if ($logo): ?>
        <div class="grid-cell md--width--50 header__brand">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="header__logo" id="logo"></a>
        </div>
        <?php endif; ?>
        <?php if (isset($page['top_menu'])): ?>
        <div class="grid-cell md--width--50 header__nav header__nav--secondary">
          <?php print render($page['top_menu']) ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php if ($is_front): ?>

    <?php endif; ?>
    <?php if (!empty($page['navigation'])) : ?>
    <div class="container padding--x-lg padding-top--xxl center">
      <nav class="header__nav header__nav--primary">
        <?php print render($page['navigation']); ?>
      </nav>
    </div>
    <?php endif; ?>
  </header>
  <?php if ($page['help'] || ($show_messages && $messages)): ?>
  <section class="background-color--gray-1">
    <div class="container padding-x--sm sm--padding-x--lg padding-y--lg padding-y--lg sm--padding-y--xl">
      <?php print render($page['help']); ?>
      <?php if ($show_messages && $messages): print $messages; endif; ?>
    </div>
  </section>
  <?php endif; ?>

  <?php if ($page['highlighted']): ?>
  <section>
    <div class="container padding-x--sm sm--padding-x--lg padding-y--lg sm--padding-y--lg sm--padding-y--xl">
      <?php print render($page['highlighted']); ?>
    </div>
  </section>
  <?php endif; ?>

  <section class="main position--relative">
    <?php if($background_image): ?>
      <div class="hero sm--show" style="background-image: url('<?php print $background_image_uri; ?>')"></div>
    <?php endif; ?>
    <div class="container position--relative z-index--1 padding-x--sm sm--padding-x--lg padding-y--lg sm--padding-y--lg sm--padding-y--xl">
      <div class="grid">
        <?php if ($page['sidebar_first']): ?>
          <div class="grid-cell width--25"><?php print render($page['sidebar_first']) ?></div>
        <?php endif; ?>
        <div class="grid-cell sm--padding-right--md <?php print ($columns > 1)? 'width--50' : 'width--100'; ?>">
          <div class="">
            <?php if ($breadcrumb && FALSE) print $breadcrumb; ?>
            <?php print render($title_prefix); ?>
            <?php if ($title): ?><h1 class="font-size--xxxl"><?php print $title ?></h1><?php endif; ?>
            <?php print render($title_suffix); ?>
            <?php if ($primary_local_tasks): ?><ul class="tabs"><?php print render($primary_local_tasks) ?></ul><?php endif; ?>
            <?php if ($secondary_local_tasks): ?><ul class="links clearfix"><?php print render($secondary_local_tasks) ?></ul><?php endif; ?>
            <?php if ($action_links): ?><ul class="links clearfix"><?php print render($action_links); ?></ul><?php endif; ?>
            <div id="content" class="clearfix"><?php print render($page['content']) ?></div>
          </div>
        </div>
        <?php if ($page['sidebar_second']): ?>
          <div class="grid-cell width--25 px2"><?php print render($page['sidebar_second']) ?></div>
        <?php endif; ?>
      </div>
    </div>

  </section>


  <footer class="bg--orange padding-y--xxl">
    <div class="container padding-x--sm sm--padding-x--lg padding-y--lg sm--padding-y--lg sm--padding-y--xxl">
      <?php if ($page['footer']): ?>
      <?php print render($page['footer']); ?>
      <?php endif; ?>
      <?php if ($page['footer_half_left'] || $page['footer_half_right']): ?>
        <div class="grid">
          <div class="grid-cell width--50">
          <?php print render($page['footer_half_left']); ?>
          </div>
          <div class="grid-cell width--50">
          <?php print render($page['footer_half_right']); ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </footer>
</div>
