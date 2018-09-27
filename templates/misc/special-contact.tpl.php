<?php
  /*
   * @file
   * Template for a special contact.
   *
   * Variables:
   * - $title: Optional title.
   * - $body: Text about the promotion
   * - $button: A call to action related to the promo.
   * - $image: .
   * - $phone:
   * - $email:
   *
   *
   *
   *
   */
?>
<div class="container padding-x--md sm--display--flex flex-wrap--wrap align-items--center">

  <div class="md--show md--width--33 padding-right--md padding-top--xxl align-self--flex-end">
    <?php if (!empty($image)): ?><?php print $image; ?><?php endif;?>
  </div>

  <div class="width--100 md--width--33 md--padding-x--md md--padding-y--xl padding-top--xl">
    <?php print theme( 'nkf_base_section_sm_header', array( 'smheader'=>$title)); ?>
    <div class="padding-top--md">
      <?php if (!empty($tagline)): ?><h4><?php print $tagline;?></h4><?php endif;?>
      <?php if (!empty($body)): ?>
        <div class="padding-bottom--sm">
          <?php print $body;?>
        </div>
      <?php endif;?>
      <div class="padding-bottom--md">
        <div><?php print $name;?></div>
        <div><?php print $nkfrole;?></div>
        <div><?php print $phone;?></div>
        <div><a href="mailto:<?php print $email;?>"><?php print $email;?></a></div>
      </div>

    </div>
  </div>
  <?php if (!empty($form)): ?>
    <div class="width--100 md--width--33 md--padding-left--md md--padding-y--xl padding-bottom--xl">
      <?php print $form; ?>
    </div>
  <?php endif;?>
</div>
