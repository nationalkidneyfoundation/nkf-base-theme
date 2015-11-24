
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
  <?php if (!empty($page['help']) || ($show_messages && !empty($messages))): ?>
  <section class="background-color--gray-1">
    <div class="container padding-x--sm sm--padding-x--lg padding-y--lg padding-y--lg sm--padding-y--xl">
      <?php print render($page['help']); ?>
      <?php if ($show_messages && $messages): print $messages; endif; ?>
    </div>
  </section>
  <?php endif; ?>

  <?php if (!empty($page['highlighted'])): ?>
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
    <section class="main__title">
      <?php if ($breadcrumb && FALSE): ?>
      <div class="container">
        <?php print $breadcrumb; ?>
      </div>
      <?php endif; ?>
      <div class="container padding-x--sm sm--padding-x--lg padding-y--lg sm--padding-y--lg sm--padding-y--xl">
        <?php print render($title_prefix); ?>
        <?php if ($title): ?><h1 class="font-size--xl sm--font-size--xxl md--font-size--xxl"><?php print $title ?></h1><?php endif; ?>
        <?php print render($title_suffix); ?>
      </div>
      <?php if ($primary_local_tasks): ?>
      <div class="container border-bottom margin-bottom--lg">
        <ul class="tabs grid list-style-type--none padding--none margin--none"><?php print render($primary_local_tasks) ?></ul>
      </div>
      <?php endif; ?>
      <?php if ($secondary_local_tasks): ?>
      <div class="container margin-bottom--lg">
        <ul class="tabs__local grid list-style-type--none padding--none margin--none links "><?php print render($secondary_local_tasks) ?></ul>
      </div>
      <?php endif; ?>
      <?php if ($action_links): ?>
      <div class="container  margin-bottom--lg">
        <ul class="tabs__action links "><?php print render($action_links); ?></ul>
      </div>
      <?php endif; ?>
    </section>
    <section class="main__content">
      <div class="container position--relative z-index--1 padding-x--sm sm--padding-x--lg padding-bottom--xl">
        <div class="grid">
          <?php if ($page['sidebar_first']): ?>
            <div class="grid-cell width--25"><?php print render($page['sidebar_first']) ?></div>
          <?php endif; ?>
          <div class="grid-cell sm--padding-right--md <?php print ($columns > 1)? 'width--50' : 'width--100'; ?>">
            <div id="content" class="clearfix"><?php print render($page['content']) ?></div>
          </div>
          <?php if ($page['sidebar_second']): ?>
            <div class="grid-cell width--25 px2"><?php print render($page['sidebar_second']) ?></div>
          <?php endif; ?>
        </div>
      </div>
    </section>

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
