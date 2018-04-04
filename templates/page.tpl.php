
<?php if(!empty($cars_noscript)) :?>
  <?php print $cars_noscript;?>
<?php endif; ?>

<!-- START OF PAGE TEMPLATE -->
<div class="<?php print $page_classes; ?>">

  <!-- ID BAND -->
  <?php if ($microsite || !empty($page['id_band'])) : ?>
    <?php if ($microsite) : ?>
      <a href="/" class="display--block bg--gray-2 color--black padding--xs caps font-size--sm text-align--center">www.kidney.org</a>
    <?php else : ?>
      <?php print render($page['id_band']); ?>
    <?php endif; ?>
  <?php endif; ?>

  <!-- NAVIGATION -->
  <?php if ($microsite) : ?>
    <?php include_once('headers/page--navigationV2--home.tpl.php'); ?>
  <?php else : ?>
    <?php include_once('headers/page--navigationV3.tpl.php'); ?>
  <?php endif; ?>


  <!-- PRINT LOGO-->
  <div class="display--none print--show text-align--center padding--xl">
    <img src="<?php print NKF_BASE_PATH;?>/img/NKF-logoR_Hori_OB.png"/>
  </div>


  <!-- MESSAGES -->
  <?php //if (!empty($page['help']) || ($show_messages && !empty($messages))): ?>
  <?php if ($show_messages && !empty($messages)): ?>
  <section class="bg--gray-1">
    <div class="container padding-y--md md--padding-y--lg padding-x--sm sm--padding-x--md md--padding-x--lg">
      <?php print render($page['help']); ?>
      <?php if ($show_messages && $messages): print $messages; endif; ?>
    </div>
  </section>
  <?php endif; ?>


  <!-- PRIMARY TABS -->
  <?php if ($primary_local_tasks): ?>
  <section class="main__tabs bg--gray-2">
    <div class="container padding-x--sm sm--padding-x--md md--padding-x--lg">
      <ul class="tabs grid--center list-style-type--none padding--none margin--none"><?php print render($primary_local_tasks) ?></ul>
    </div>
  </section>
  <?php endif; ?>


  <!-- MAIN -->
  <main class="main position--relative z-index--100">

    <!-- TOP PROMO -->
    <?php if ($page['top_promo'] && !empty($page['top_promo'])): ?>
    <section class="position--absolute top left right print--hide">
      <?php print render($page['top_promo']);?>
    </section>
    <?php endif; ?>

    <!-- (DEPRECATED) BACKGROUND IMAGE -->
    <?php if($background_image && $node->type =='donation'): ?>
      <div class="hero sm--show" style="background-image: url('<?php print $background_image_uri; ?>')"></div>
    <?php endif; ?>

    <!-- (DEPRECATED) BREADCRUMBS -->
    <?php if ($breadcrumb && FALSE): ?>
    <section class="main__breadcrumbs">
      <div class="container padding-top--md md--padding-top--lg padding-x--sm sm--padding-x--md md--padding-x--lg">
        <?php print $breadcrumb; ?>
      </div>
    </section>
    <?php endif; ?>

    <!-- TITLE -->
    <?php if ($has_title) : ?>
      <?php if ($title): ?>
        <section class="main__title padding-y--lg">
          <div class="container padding-y--xl padding-x--sm sm--padding-x--md md--padding-x--lg">
            <?php print render($title_prefix); ?>
            <h1 class="font-size--xxl padding--none">
              <div class="prose center padding-x--md md--padding-x--none">
                <?php print $title ?>
              </div>
            </h1>
            <?php print render($title_suffix); ?>
          </div>
        </section>
      <?php endif; ?>
    <?php endif;?>


    <!-- SECONDARY TABS TODO: MOVE UP -->
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
      <?php if (!$widescreen): ?>
      <div class="container padding-top--xl padding-bottom--xxxl padding-x--sm sm--padding-x--md md--padding-x--lg position--relative z-index--1">
        <div class="grid">
          <?php if ($page['sidebar_first']): ?>
            <div class="sidebar grid-cell sm--width--25 width--100"><?php print render($page['sidebar_first']) ?></div>
          <?php endif; ?>
          <div class="grid-cell sm--padding-right--md <?php print ($columns > 1)? 'sm--width--60 width--100' : 'width--100'; ?>">
            <div id="content" class="clearfix"><?php print render($page['content']) ?></div>
          </div>
          <?php if ($page['sidebar_second']): ?>
            <div class="sidebar grid-cell sm--width--25 width--100 sm--padding-left--md"><?php print render($page['sidebar_second']) ?></div>
          <?php endif; ?>
        </div>
      </div>
      <?php else: ?>
      <div class="position--relative z-index--1">
        <div class="grid">
          <div class="grid-cell width--100">
            <div id="content" class="clearfix"><?php print render($page['content']) ?></div>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </section>
  </main>


  <!-- FOOTER -->
  <footer class="footer bg--gray-1">
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
