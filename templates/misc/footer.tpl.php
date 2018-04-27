<footer class="border-top">
  <div class="container padding-top--xxxl margin-top--xxxl">
    <div class="display--flex flex-wrap--wrap padding-x--md">
      <div class="md--width--40 width--100 sm--padding-x--lg padding-x--md order--2">
        <h4 class="padding-y--xxs padding-top--lg md--padding-top--none">Our Passion</h4>
        <p>
        Fueled by passion and urgency, NKF is a lifeline for all people affected by kidney disease. As pioneers of scientific research and innovation, NKF focuses on the whole patient through the lens of kidney health. Relentless in our work, we enhance lives through <strong>action</strong>, <strong>education</strong> and <strong>accelerating change</strong>.</p>
        <div class="adr">
          <div class="street-address">30 East 33rd Street</div>
          <span class="locality">New York</span>,
          <span class="region">NY</span>
          <span class="postal-code">10016</span>
          <div class="hide country-name">U.S.A.</div>
        </div>
        <div class="tel padding-bottom--md">1.800.622.9010</div>

        <p class="">© 2017 National Kidney Foundation, Inc.</p>
        <p>
      </div>
      <div class="hide sm--width--33 md--width--20 width--100 sm--padding-x--lg padding-x--md">
        <h4 class="padding-y--xxs">Navigation</h4>
        <ul class="list--reset padding--none margin--none">
          <?php foreach($ia as $item): ?>
            <li class="padding-bottom--xxxs"><a class="" href="<?php print $item['path'];?>"><?php print $item['name'];?></a>
          <?php endforeach;?>
        </ul>
      </div>
      <div class="sm--width--33 md--width--20 width--100 sm--padding-x--lg padding-x--md">
        <h4 class="padding-y--xxs">NKF</h4>
        <ul class="list--reset padding--none margin--none">
          <?php foreach($nkf as $item): ?>
            <li class="padding-bottom--xxxs"><a class="" href="<?php print $item['path'];?>"><?php print $item['name'];?></a>
          <?php endforeach;?>
        </ul>
      </div>
      <div class=" sm--width--33 md--width--20 width--100 sm--padding-x--lg padding-x--md">
        <h4 class="padding-y--xxs">Legal</h4>
        <ul class="list--reset padding--none margin--none">
          <?php foreach($legal as $item): ?>
            <li class="padding-bottom--xxxs"><a class="" href="<?php print $item['path'];?>"><?php print $item['name'];?></a>
          <?php endforeach;?>
        </ul>
      </div>
      <div class="hide sm--width--33 md--width--20 width--100 sm--padding-x--lg padding-x--md">
        <h4 class="padding-y--xxs">Badges</h4>
        <ul class="list--reset padding--none margin--none">
          <?php foreach($badges as $item): ?>
            <li class="padding-bottom--xxxs"><a class="" href="<?php print $item['path'];?>"><?php print $item['name'];?></a>
          <?php endforeach;?>
        </ul>
      </div>
      <div class="sm--width--33 md--width--20 width--100 sm--padding-x--lg padding-x--md">
        <h4 class="padding-y--xxs">Follow us</h4>
        <ul class="list--reset padding--none margin--none">
          <?php foreach($follow as $item): ?>
            <li class="padding-bottom--xxxs"><a class="" href="<?php print $item['path'];?>"><?php print $item['name'];?></a>
          <?php endforeach;?>
        </ul>
      </div>
    </div>
  </div>
  <div class="">
    <img src="/<?php print NKF_BASE_PATH; ?>/img/footer_curve.png"></img>
  </div>
</footer>
