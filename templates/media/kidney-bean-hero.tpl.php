<section class="padding-bottom--xxl">
  <div class="width--100 center position--relative">
      <div class="position--relative">
          <img class="display--block width--100 md--width--80 overflow--hidden" src="<?php print $hero_image;?>" alt="">
      
      <div class="hide md--show position--absolute kidney-bean--overlay--right">
          <div class="position--absolute padding--xl width--30 md--width--50 lg--width--60 kidney-bean--hero--text">
              <div class="font-size--xl md--font-size--xxl lg--font-size--xxxl xl--font-size--xxxxl bold color--white"><?php print $title;?></div>
              <div class="color--black font-size--lg md--font-size--xl lg--font-size--xxl xl--font-size--xxxl"><?php print $body;?></div>
              <?php if (!empty($ctas)): ?>
          <?php foreach($ctas as $i => $cta): ?>
            <a class="margin-x--xxxs margin-top--xs <?php print $cta['button'] ?>" href="<?php print $cta['url']; ?>"><?php print $cta['title'];?></a>
          <?php endforeach; ?>
      <?php endif;?>
      </div>
    </div>
    <div class="edge--wavy--bottom--bean"></div>
</div>
  <div class="show md--hide padding-x--md padding-y--md text-align--right">
      <div class="font-size--xxl bold color--orange"><?php print $title;?></div>
      <div class="color--black font-size--xl"><?php print $body;?></div>
      <?php if (!empty($ctas)): ?>
          <?php foreach($ctas as $i => $cta): ?>
            <a class="margin-x--xxxs margin-top--xs <?php print $cta['button'] ?>" href="<?php print $cta['url']; ?>"><?php print $cta['title'];?></a>
          <?php endforeach; ?>
        </div>
      <?php endif;?>
  </div>
</section>


