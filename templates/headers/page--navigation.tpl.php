<!-- HEADER -->
<header class="header print--hide <?php print (!empty($page['highlighted'])) ? 'bg--white' : 'bg--orange' ?>">
  <!-- LOGO & TOP NAV -->
  <section>
    <div class="container padding-y--md md--padding-y--lg padding-x--sm sm--padding-x--md md--padding-x--lg">
      <div class="grid">
        <!-- LOGO -->
        <?php if ($logo): ?>
        <div class="grid-cell width--30 header__brand">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="header__logo" id="logo"></a>
        </div>
        <?php endif; ?>

        <!-- NAVIGATION REGION -->
        <?php if (!empty($page['navigation'])) : ?>
        <nav class="nav nav--primary grid-cell width--70">
          <div class="nav__nav sm--show"><?php print render($page['navigation']); ?></div>
          <div class="nav__menu sm--hide color--white cursor--pointer" data-toggle="class" data-target=".nav__nav" data-class="sm--show">
            <i class="icon-menu"></i>
          </div>
        </nav>
        <?php endif; ?>

        <?php if (isset($page['top_menu']) && FALSE): ?>
        <div class="grid-cell md--width--70 nav nav--secondary">
          <div class="sm--show"><?php print render($page['top_menu']) ?></div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>


  <!-- HIGHLIGHTED REGION -->
  <?php if (!empty($page['highlighted']) || $node_highlight): ?>
  <section class="position--relative overflow--hidden">
    <?php if (!empty($page['highlighted'])) : ?>
      <?php print render($page['highlighted']); ?>
    <?php else : ?>
      <div class="background-size--cover <?php if ($background_image || $background_video): ?> min-height--xxl<?php endif;?>"
        <?php if ($background_image): ?> style="background-image: url('<?php print $background_image_uri; ?>')"<?php endif;?>>
        <?php if ($background_video) :?>
          <video class="z-index--100 md--show width--100 height--auto cover-absolute" preload="auto" loop="loop" autoplay="autoplay" muted="true">
            <?php if (!empty($background_video_mp4)): ?>
              <source src="<?php print $background_video_mp4; ?>" type="video/mp4">
            <?php endif;?>
            <?php if (!empty($background_video_webm)): ?>
              <source src="<?php print $background_video_webm; ?>" type="video/webm">
            <?php endif;?>
            <?php if (!empty($background_video_ogg)): ?>
              <source src="<?php print $background_video_ogg; ?>" type="video/ogg">
            <?php endif;?>

          </video>
        <?php endif; ?>
        <div class="position--relative z-index--200 container padding-y--md md--padding-y--lg padding-x--sm sm--padding-x--md md--padding-x--lg">
          <?php print $node_highlight_text; ?>
        </div>
      </div>
    <?php endif; ?>

  </section>
  <?php endif; ?>


</header>
