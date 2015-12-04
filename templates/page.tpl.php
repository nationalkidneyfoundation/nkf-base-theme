
<!-- START OF PAGE TEMPLATE -->
<div class="<?php print $page_classes; ?>">

  <!-- HEADER -->
  <header class="header bg--orange">
    <!-- LOGO & TOP NAV -->
    <section>
      <div class="container padding-y--md md--padding-y--lg padding-x--sm sm--padding-x--md md--padding-x--lg">
        <div class="grid">
          <?php if ($logo): ?>
          <div class="grid-cell md--width--30 header__brand">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="header__logo" id="logo"></a>
          </div>
          <?php endif; ?>
          <?php if (isset($page['top_menu'])): ?>
          <div class="grid-cell md--width--70 nav nav--secondary">
            <div class="sm--show"><?php print render($page['top_menu']) ?></div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </section>


    <!-- HIGHLIGHTED REGION -->
    <?php if (!empty($page['highlighted'])): ?>
    <section class="position--relative">
      <!--<div class="container padding-y--md md--padding-y--lg padding-x--sm sm--padding-x--md md--padding-x--lg">-->
        <?php print render($page['highlighted']); ?>
      <!--<</div>-->
    </section>
    <?php endif; ?>


    <!-- NAVIGATION REGION -->
    <?php if (!empty($page['navigation'])) : ?>
    <nav class="nav nav--primary bg--orange">
      <div class="container padding-top--md md--padding-top--lg padding-x--sm sm--padding-x--md md--padding-x--lg sm--show">
        <?php print render($page['navigation']); ?>
      </div>
      <div class="nav__menu sm--hide color--white cursor--pointer" data-toggle="class" data-target=".nav--primary .container" data-class="sm--show">
        <i class="icon-menu"></i>menu
      </div>
    </nav>
    <?php endif; ?>
  </header>


  <!-- MESSAGES -->
  <?php //if (!empty($page['help']) || ($show_messages && !empty($messages))): ?>
  <?php if ($show_messages && !empty($messages)): ?>
  <section class="background-color--gray-1">
    <div class="container padding-y--md md--padding-y--lg padding-x--sm sm--padding-x--md md--padding-x--lg">
      <?php print render($page['help']); ?>
      <?php if ($show_messages && $messages): print $messages; endif; ?>
    </div>
  </section>
  <?php endif; ?>


  <!-- MAIN -->
  <main class="main position--relative">
    <!-- BACKGROUND IMAGE -->
    <?php if($background_image): ?>
      <div class="hero sm--show" style="background-image: url('<?php print $background_image_uri; ?>')"></div>
    <?php endif; ?>

    <!-- BREADCRUMBS -->
    <?php if ($breadcrumb): ?>
    <section class="main__breadcrumbs">
      <div class="container padding-top--md md--padding-top--lg padding-x--sm sm--padding-x--md md--padding-x--lg">
        <?php print $breadcrumb; ?>
      </div>
    </section>
    <?php endif; ?>

    <!-- TITLE -->
    <section class="main__title">
      <div class="container padding-top--md md--padding-top--lg padding-x--sm sm--padding-x--md md--padding-x--lg">
        <?php print render($title_prefix); ?>
        <?php if ($title): ?><h1 class="font-size--xxl md--font-size--xxxl"><?php print $title ?></h1><?php endif; ?>
        <?php print render($title_suffix); ?>
      </div>
    </section>

    <!-- PRIMARY TABS -->
    <?php if ($primary_local_tasks): ?>
    <section class="main__tabs">
      <div class="container padding-x--sm sm--padding-x--md md--padding-x--lg">
        <ul class="tabs grid list-style-type--none padding--none margin--none"><?php print render($primary_local_tasks) ?></ul>
      </div>
    </section>
    <?php endif; ?>

    <!-- SECONDARY TABS -->
    <?php if ($secondary_local_tasks): ?>
    <section class="main__tasks">
      <div class="container padding-top--md md--padding-top--lg padding-x--sm sm--padding-x--md md--padding-x--lg">
        <ul class="tabs__local grid list-style-type--none padding--none margin--none links "><?php print render($secondary_local_tasks) ?></ul>
      </div>
    </section>
    <?php endif; ?>

    <!-- ACTION LINKS -->
    <?php if ($action_links): ?>
    <section class="main__action-links">
      <div class="container padding-top--md md--padding-top--lg padding-x--sm sm--padding-x--md md--padding-x--lg">
        <ul class="tabs__action links "><?php print render($action_links); ?></ul>
      </div>
    </section>
    <?php endif; ?>

    <!-- MAIN CONTENT -->
    <section class="main__content">
      <div class="container padding-top--lg padding-bottom--xxxl padding-x--sm sm--padding-x--md md--padding-x--lg position--relative z-index--1">
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
  </main>


  <!-- FOOTER -->
  <footer class="footer margin-top--xxxl bg--gray-1 border-top-width--lg border-color--gray-3 border-style--solid">
    <div class="container padding-y--xxxl padding-x--sm sm--padding-x--md md--padding-x--lg ">
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
