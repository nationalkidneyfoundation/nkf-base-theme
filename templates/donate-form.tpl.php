
<?php


?>
<pre>
  <?php print_r(element_children($form['customer_profile']['commerce_customer_address'][LANGUAGE_NONE][0]));?>
</pre>
<div class="test">
  <?php //print drupal_render_children($form); ?>
</div>

<div class="tsting">
  <div class="donation-step">
    <div class="donation-step__inner grid">
      <div class="grid-cell width--100 text-align--center">
        <?php print render($form['donation']); ?>
      </div>
      <div class="grid-cell width--100">
        <?php print render($form['field_monthly_recurring']); ?>
      </div>
      <div class="grid-cell width--100">
        <?php print render($form['line_item']['field_company_match_flag']); ?>
      </div>
      <div class="grid-cell width--100 float--left">
        <?php print render($form['line_item']['field_company_match']); ?>
      </div>
      <div class="grid-cell width--100">
        <?php print render($form['line_item']['field_honor_flag']); ?>
      </div>
    </div>
  </div>
  <div class="donation-step">
    <div class="donation-step__inner grid">
      <div class="grid-cell sm--width--50 width--100">
        <?php print render($form['redhen_contact']['form']['name']['first_name']); ?>
      </div>
      <div class="grid-cell sm--width--50 width--100">
        <?php print render($form['redhen_contact']['form']['name']['last_name']); ?>
      </div>
      <div class="grid-cell sm--width--50 width--100">
        <?php print render($form['redhen_contact']['form']['email']); ?>
      </div>
      <div class="grid-cell sm--width--50 width--100">
        <?php print render($form['redhen_contact']['form']['phone']); ?>
      </div>
      <div class="grid-cell width--100">
        <?php print render($form['customer_profile']['commerce_customer_address'][LANGUAGE_NONE][0]['street_block']['thoroughfare']); ?>
      </div>
      <div class="grid-cell width--50">
        <?php print render($form['customer_profile']['commerce_customer_address'][LANGUAGE_NONE][0]['locality_block']['locality']); ?>
      </div>
      <div class="grid-cell width--20">
        <?php print render($form['customer_profile']['commerce_customer_address'][LANGUAGE_NONE][0]['locality_block']['administrative_area']); ?>
      </div>
      <div class="grid-cell width--30">
        <?php print render($form['customer_profile']['commerce_customer_address'][LANGUAGE_NONE][0]['locality_block']['postal_code']); ?>
      </div>
      <div class="grid-cell width--100">
        <?php print render($form['customer_profile']['commerce_customer_address'][LANGUAGE_NONE][0]['country']); ?>
      </div>
    </div>
  </div>
  <div class="donation-step">
    <div class="donation-step__inner">

    </div>
  </div>
</div>
