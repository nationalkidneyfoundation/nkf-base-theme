
<!-- START OF PAGE TEMPLATE -->
<div class="<?php print $page_classes; ?>">

  <?php if ($microsite_path || !empty($page['id_band'])) : ?>
    <div class="bg--mustard">
      <div class="container text-align--center">
        <?php if ($microsite_path) : ?>
          <div class="caps font-size--sm"><?php print $microsite_path; ?></div>
        <?php else : ?>
          <?php print render($page['id_band']); ?>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
  <?php if ($v2) : ?>
    <?php if ($microsite_home) : ?>
      <?php include_once('headers/page--navigationV2--home.tpl.php'); ?>
    <?php else : ?>
      <?php include_once('headers/page--navigationV2.tpl.php'); ?>
    <?php endif; ?>


  <?php else : ?>
    <?php include_once('headers/page--navigation.tpl.php'); ?>
  <?php endif; ?>

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
  <main class="main position--relative z-index--100">
    <!-- BACKGROUND IMAGE -->
    <?php if($background_image && $node->type =='donation'): ?>
      <div class="hero sm--show" style="background-image: url('<?php print $background_image_uri; ?>')"></div>
    <?php endif; ?>

    <!-- BREADCRUMBS -->
    <?php if ($breadcrumb && FALSE): ?>
    <section class="main__breadcrumbs">
      <div class="container padding-top--md md--padding-top--lg padding-x--sm sm--padding-x--md md--padding-x--lg">
        <?php print $breadcrumb; ?>
      </div>
    </section>
    <?php endif; ?>

    <!-- TITLE -->
    <?php if (!$microsite_home) : ?>
      <?php if ($title): ?>
        <section class="main__title">
          <div class="container padding-top--md md--padding-top--lg padding-x--sm sm--padding-x--md md--padding-x--lg">
            <?php print render($title_prefix); ?>
            <h1 class="font-size--xl sm--font-size--xxl padding-bottom--none"><?php print $title ?></h1>
            <?php print render($title_suffix); ?>
          </div>
        </section>
      <?php endif; ?>
    <?php endif;?>

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
      <div class="container padding-top--xl padding-bottom--xxxl padding-x--sm sm--padding-x--md md--padding-x--lg position--relative z-index--1">
        <div class="grid">
          <?php if ($page['sidebar_first']): ?>
            <div class="grid-cell sm--width--25 width--100"><?php print render($page['sidebar_first']) ?></div>
          <?php endif; ?>
          <div class="grid-cell sm--padding-right--md <?php print ($columns > 1)? 'sm--width--60 width--100' : 'width--100'; ?>">
            <div id="content" class="clearfix"><?php print render($page['content']) ?></div>
          </div>
          <?php if ($page['sidebar_second']): ?>
            <div class="grid-cell sm--width--25 width--100 sm--padding-left--md"><?php print render($page['sidebar_second']) ?></div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>


  <!-- FOOTER -->
  <footer class="footer margin-top--xxxl bg--gray-1">
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
