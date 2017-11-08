<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<?php
  //print '<pre>';
  //array_keys(var_dump(get_defined_vars()));
  //print '</pre>';
?>
<?php
  // FIELDS
  /* group_group
    group_event_general_info
    title
    field_event_title_prefix
    field_event_title_suffix
    field_event_cta
    field_event_section1_title
    body
    field_event_hero_image
    field_event_contact
    field_base_email
    field_base_phone
    field_event_schedule_title
    field_event_schedule
    group_event_vip1
    field_event_vip1_toggle
    field_event_vip1_title
    field_event_vip_1_prefix
    field_event_vip_1
    field_event_vip_1_suffix
    group_event_vip2
    field_event_vip2_toggle
    field_event_vip2_title
    field_event_vip_2_prefix
    field_event_vip_2
    field_event_vip_2_suffix
    group_event_vip3
    field_event_vip3_toggle
    field_event_vip3_title
    field_event_vip_3_prefix
    field_event_vip_3
    field_event_vip_3_suffix
    group_event_auction
    field_event_auction_toggle
    field_event_auction_title
    field_event_auction_prefix
    field_event_auction_description
    field_event_auction_items
    field_event_auction_suffix
    group_event_time_location
    field_event_location_toggle
    field_event_location_title
    field_event_location_prefix
    field_base_location_reference
    field_event_special_instructions
    field_base_date_time
    field_event_location_suffix
    group_event_volunteer
    field_event_volunteer_toggle
    field_event_volunteer_title
    field_event_volunteer_prefix
    field_event_volunteer_descript
    field_event_volunteer_suffix
    group_event_photos
    field_event_photos_toggle
    field_event_photos_title
    field_event_photos_prefix
    field_event_event_photos1
    field_event_photos_suffix
    group_event_social_media
    field_event_social_media_toggle
    field_event_social_media_title
    field_event_social_fb_share
    field_base_link
    field_event_social_email_share
    group_event_nkf_branding
    field_event_branding_toggle
    field_event_branding_title
    field_event_nkf_text
    field_event_local_text
  */
  //
  $i = 0;
?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>


  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
    ?>

    <?php if ($has_nav_sub) :?>
      <?php include(NKF_BASE_PATH .'/templates/partials/sticky-header-in-content.tpl.php'); ?>
    <?php endif;?>

    <!-- TOP -->
    <section class="nav-section width--100 grid-cell <?php print $hero_classes;?> <?php print $th['hero']; ?>">
      <a id="home" class="nav-anchor"></a>
      <div class="container padding-y--xxl">
        <div class="md--display--table width--100">
          <div class="md--display--table-cell vertical-align--middle width--100 md--width--50 text-align--center">
            <div class="padding-x--lg padding-y--xl">
              <?php if (isset($content['field_event_title_prefix'])): ?>
                <div class="caps bold">
                  <?php print render($content['field_event_title_prefix']); ?>
                </div>
              <?php endif; ?>
              <h1 class="md--font-size--xxxxl font-size--xxxl padding-y--none lg--padding-x--lg line-height--110">
                <?php print render($title); ?>
              </h1>
              <?php if (isset($content['field_event_title_suffix'])): ?>
                <div class="padding-top--md caps font-size--lg">
                  <?php print render($content['field_event_title_suffix']); ?>
                </div>
              <?php endif; ?>
              <div class="padding-top--lg">
                <a href="#location" class="local display--block color--inherit">
                  <div class="caps bold">
                    <?php print render($content['field_base_date_time']); ?>
                  </div>
                  <div class="caps">
                    <?php print $city . ', ' . $state; ?>
                  </div>
                </a>
              </div>
              <div class="padding-top--lg md--padding-top--xxl font-size--s">
                <?php foreach($ctas as $i => $cta): ?>
                  <a
                    class="<?php print $cta['button']; ?> sm--width--auto width--100 margin-y--xxs sm--margin-right--xs caps"
                    href="<?php print $cta['url']; ?>">
                    <?php print $cta['title']; ?>
                  </a>
                <?php endforeach;?>
              </div>
            </div>
          </div>
          <div class="md--display--table-cell vertical-align--middle width--100 md--width--50 md--padding--xs">
            <img class="rounded display--block width--100" src="<?php print $hero_url; ?>">
          </div>
        </div>
      </div>
    </section>
    <!-- TOP END -->

    <!-- ABOUT -->
    <section class="nav-section width--100 grid-cell <?php print $section_classes;?> <?php print $i%2 == 0 ? '' : $th['odd_section'];?>">
      <a id="about" class="nav-anchor"></a>
      <div class="container padding-y--xxl">
        <div class="grid">
          <div class="grid-cell md--width--66 width--100 padding-x--xl">
            <h2 class="title padding-bottom--lg caps">About this event</h2>
            <?php print render($content['body']); ?>
            <?php if(isset($content['field_event_contact'])): ?>
              <div class="padding-top--md">
                <?php print_field($content['field_event_contact']);?>
                For more information about this event contact <span class="bold"><?php print_field($content['field_event_contact']);?></span> at
                <?php if (isset($content['field_base_email'])):?>
                  <a href="mailto:<?php print_field($content['field_base_email']);?>">
                    <?php print_field($content['field_base_email']);?>
                  </a>
                <?php endif;?>
                <?php if (isset($content['field_base_phone']) && isset($content['field_base_email'])):?>
                   /
                <?php endif;?>
                <?php if (isset($content['field_base_phone'])):?>
                  <?php print_field($content['field_base_phone']);?>
                <?php endif;?>
              </div>
            <?php endif;?>
            <?php if(isset($content['field_event_schedule_title']) && isset($content['field_event_schedule'])): ?>
              <h2 class="title padding-y--lg caps"><?php print render($content['field_event_schedule_title']);?></h2>
              <?php print render($content['field_event_schedule']); ?>
            <?php endif; ?>
          </div>
          <div class="grid-cell md--width--33">
            <div class="md--show sticky-nav top padding-x--lg position--relative z-index--400">
              <div class="width--lg">
                <div class="label height--sm padding-x--xs padding-y--sm text-align--center caps bold font-size--sm <?php print $th['header'];?>">Event Details</div>
                <ul class="list--reset padding-y--md padding-x--md margin--none  bg--gray-2--o70 ">
                  <?php foreach ($sections as $key => $value): ?>
                    <?php if ($value['include']): ?>
                      <li>
                        <a href="#<?php print $key; ?>" class="color--black display--block padding-bottom--xxs"><?php print $value['title']; ?></a>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ABOUT END -->

    <!-- VIP1 -->
    <?php if($sections['vip1']['include']): ?>
      <?php ++$i;?>
    <section class="nav-section width--100 grid-cell <?php print $section_classes;?> <?php print $i%2 == 0 ? '' : $th['odd_section'];?>">
      <a id="vip1" class="nav-anchor"></a>
      <div class="container padding-y--xxl">
        <div class="grid">
          <div class="grid-cell md--width--66 width--100 padding-x--xl">
            <h2 class="title padding-bottom--lg caps"><?php print render($content['field_event_vip1_title']); ?></h2>
            <?php if (isset($content['field_event_vip_1_prefix'])): ?>
              <div class="font-size--lg">
                <?php print render($content['field_event_vip_1_prefix']); ?>
              </div>
            <?php endif; ?>
            <?php print render($content['field_event_vip_1']); ?>
            <?php if (isset($content['field_event_vip_1_suffix'])): ?>
              <div class="padding-bottom--md">
                <?php print render($content['field_event_vip_1_suffix']); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="grid-cell md--width--33">
          </div>
        </div>
      </div>
    </section>
    <?php endif;?>
    <!-- VIP1 END -->

    <!-- VIP2 -->
    <?php if($sections['vip2']['include']): ?>
      <?php ++$i;?>
    <section class="nav-section width--100 grid-cell <?php print $section_classes;?> <?php print $i%2 == 0 ? '' : $th['odd_section'];?>">
      <a id="vip2" class="nav-anchor"></a>
      <div class="container padding-y--xxl">
        <div class="grid">
          <div class="grid-cell md--width--66 width--100 padding-x--xl">
            <h2 class="title padding-bottom--lg caps"><?php print render($content['field_event_vip2_title']); ?></h2>
            <?php if (isset($content['field_event_vip_2_prefix'])): ?>
              <div class="font-size--lg">
                <?php print render($content['field_event_vip_2_prefix']); ?>
              </div>
            <?php endif; ?>
            <?php print render($content['field_event_vip_2']); ?>
            <?php if (isset($content['field_event_vip_2_suffix'])): ?>
              <div class="padding-bottom--md">
                <?php print render($content['field_event_vip_2_suffix']); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="grid-cell md--width--33">
          </div>
        </div>
      </div>
    </section>
    <?php endif;?>
    <!-- VIP2 END -->

    <!-- VIP3 -->
    <?php if($sections['vip3']['include']): ?>
      <?php ++$i;?>
    <section class="nav-section width--100 grid-cell <?php print $section_classes;?> <?php print $i%2 == 0 ? '' : $th['odd_section'];?>">
      <a id="vip3" class="nav-anchor"></a>
      <div class="container padding-y--xxl">
        <div class="grid">
          <div class="grid-cell md--width--66 width--100 padding-x--xl">
            <h2 class="title padding-bottom--lg caps"><?php print render($content['field_event_vip3_title']); ?></h2>
            <?php if (isset($content['field_event_vip_3_prefix'])): ?>
              <div class="font-size--lg">
                <?php print render($content['field_event_vip_3_prefix']); ?>
              </div>
            <?php endif; ?>
            <?php print render($content['field_event_vip_3']); ?>
            <?php if (isset($content['field_event_vip_3_suffix'])): ?>
              <div class="padding-bottom--md">
                <?php print render($content['field_event_vip_3_suffix']); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="grid-cell md--width--33">
          </div>
        </div>
      </div>
    </section>
    <?php endif;?>
    <!-- VIP3 END -->

    <!-- AUCTION -->
    <?php if($sections['auction']['include']): ?>
      <?php ++$i;?>
    <section class="nav-section width--100 grid-cell <?php print $section_classes;?> <?php print $i%2 == 0 ? '' : $th['odd_section'];?>">
      <a id="auction" class="nav-anchor"></a>
      <div class="container padding-y--xxl">
        <div class="grid">
          <div class="grid-cell md--width--66 width--100 padding-x--xl">
            <h2 class="title padding-bottom--lg caps"><?php print render($content['field_event_auction_title']); ?></h2>
            <?php if (isset($content['field_event_auction_prefix'])): ?>
              <div class="padding-bottom--md font-size--lg">
                <?php print render($content['field_event_auction_prefix']); ?>
              </div>
            <?php endif; ?>
            <div class="padding-bottom--lg">
              <?php print render($content['field_event_auction_description']); ?>
            </div>
            <?php if (isset($content['field_event_auction_suffix'])): ?>
              <div class="padding-bottom--md">
                <?php print render($content['field_event_auction_suffix']); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="grid-cell md--width--33">
          </div>
        </div>
      </div>
    </section>
    <?php endif;?>
    <!-- AUCTION END -->

    <!-- LOCATION -->
    <?php if($sections['location']['include']): ?>
      <?php ++$i;?>
    <section class="nav-section width--100 grid-cell <?php print $section_classes;?> <?php print $i%2 == 0 ? '' : $th['odd_section'];?>">
      <a id="location" class="nav-anchor"></a>
      <div class="container padding-y--xxl">
        <div class="grid">
          <div class="grid-cell md--width--66 width--100 padding-x--xl">
            <h2 class="title padding-bottom--lg caps"><?php print render($content['field_event_location_title']); ?></h2>
            <?php if (isset($content['field_event_location_prefix'])): ?>
              <div class="padding-bottom--md font-size--lg">
                <?php print render($content['field_event_location_prefix']); ?>
              </div>
            <?php endif; ?>
            <?php if (isset($content['field_base_date_time'])): ?>
              <div class="padding-bottom--lg">
                <div class="font-size--lg bold">
                  <?php print render($content['field_base_date_time']); ?>
                </div>
              </div>
            <?php endif; ?>
            <?php if (isset($content['field_base_address'])): ?>
            <div class="grid padding-bottom--md">
              <div class="grid-cell width--100 md--width--65">
                <a class="display--block" href="https://www.google.com/maps/search/?api=1&query=<?php print $address_url; ?>">
                  <div
                    class="width--100 height--xl background-size--cover background-position--bottom"
                    style="background-image:url('https://api.mapbox.com/styles/v1/mapbox/streets-v10/static/pin-l+000(<?php print $longitude; ?>,<?php print $latitude; ?>)/<?php print $longitude; ?>,<?php print $latitude; ?>,15/1000x350@2x?access_token=pk.eyJ1IjoibmtmIiwiYSI6ImNpeXlycHIwdTAwdGozMnBvcHVyb3dsMHUifQ.Ga4ktI5QmMOipTSAG1If7g')">
                  </div>
                </a>
              </div>
                <div class="grid-cell width--100 md--width--35">

                  <div class="padding--lg">
                    <div class="display--inline-block">
                      <?php if (isset($content['field_location_site'])): ?>
                        <div class="font-size--lg bold">
                          <?php print render($content['field_location_site']); ?>
                        </div>
                      <?php endif;?>
                      <?php print render($content['field_base_address']); ?>

                      <a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination=<?php print $address_url; ?>">
                        Directions
                      </a>

                      <?php if (isset($content['field_event_special_instructions'])): ?>
                        <div class="padding-top--sm">
                          <?php print render($content['field_event_special_instructions']); ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <?php if (isset($content['field_event_location_suffix'])): ?>
              <div class="padding-bottom--md">
                <?php print render($content['field_event_location_suffix']); ?>
              </div>
            <?php endif; ?>
          <div class="grid-cell md--width--33">
          </div>
        </div>
      </div>
    </section>
    <?php endif;?>
    <!-- LOCATION END -->
    <!-- VOLUNTEER -->
    <?php if($sections['volunteer']['include']): ?>
      <?php ++$i;?>
    <section class="nav-section width--100 grid-cell <?php print $section_classes;?> <?php print $i%2 == 0 ? '' : $th['odd_section'];?>">
      <a id="volunteer" class="nav-anchor"></a>
      <div class="container padding-y--xxl">
        <div class="grid">
          <div class="grid-cell md--width--66 width--100 padding-x--xl">
            <h2 class="title padding-bottom--lg caps"><?php print render($content['field_event_volunteer_title']); ?></h2>
            <?php if (isset($content['field_event_volunteer_prefix'])): ?>
              <div class="padding-bottom--md font-size--lg">
                <?php print render($content['field_event_volunteer_prefix']); ?>
              </div>
            <?php endif; ?>
            <?php print render($content['field_event_volunteer_descript']); ?>
          </div>
          <div class="grid-cell md--width--33">
          </div>
        </div>
      </div>
    </section>
    <?php endif;?>
    <!-- VOLUNTEER END -->
    <!-- PHOTOS -->
    <?php if($sections['photos']['include']): ?>
      <?php ++$i;?>
    <section class="nav-section width--100 grid-cell <?php print $section_classes;?> <?php print $i%2 == 0 ? '' : $th['odd_section'];?>">
      <a id="photos" class="nav-anchor"></a>
      <div class="container padding-y--xxl">
        <div class="grid">
          <div class="grid-cell md--width--66 width--100 padding-x--xl">
            <h2 class="title padding-bottom--lg caps"><?php print render($content['field_event_photos_title']); ?></h2>
            <?php if (isset($content['field_event_photos_prefix'])): ?>
              <div class="padding-bottom--md font-size--lg">
                <?php print render($content['field_event_photos_prefix']); ?>
              </div>
            <?php endif; ?>
            <div class="modal-gallery width--100 padding-bottom--md clearfix">
              <?php foreach($photos as $photo): ?>
                <a class="float--left padding-bottom--xs padding-right--xs" href="<?php print $photo['src_full']; ?>">
                  <img
                    src="<?php print $photo['src_thumb']; ?>"
                    class=""
                    title="<?php print $photo['title']; ?>"
                    alt="<?php print $photo['alt']; ?>"/>
                </a>

              <?php endforeach;?>
            </div>
            <?php if (isset($content['field_event_photos_suffix'])): ?>
              <div class="padding-bottom--md">
                <?php print render($content['field_event_photos_suffix']); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="grid-cell md--width--33">
          </div>
        </div>
      </div>
    </section>
    <?php endif;?>
    <!-- PHOTOS END -->
    <!-- SHARING AND BRANDING -->
    <?php ++$i;?>
    <section class="nav-section width--100 grid-cell <?php print $section_classes;?> <?php print $i%2 == 0 ? '' : $th['odd_section'];?>">
      <?php ++$i;?>
      <a id="aboutnkf" class="nav-anchor"></a>
      <div class="container padding-y--xxl">
        <div class="grid">
          <div class="grid-cell md--width--66 width--100 padding-x--xl">
            <div class="grid width--100">
              <?php if($content['field_event_social_media_toggle']): ?>
                <div class="font-size--lg grid-cell width--100 text-align--center md--width--30 md--padding-right--xl padding-y--md">
                  <h2 class="title caps padding-bottom--lg"><?php print render($content['field_event_social_media_title']); ?></h2>
                  <?php if($social_actions) :?>
                  <?php foreach ($social_actions as $key => $action): ?>
                    <div class="display--inline-block md--display--block">
                      <a href="<?php print $action['href']; ?>" class="<?php print $action['button']?> caps display--block margin-y--xs">
                        <i class="<?php print $action['icon'];?>"></i>
                      </a>
                    </div>
                  <?php endforeach;?>
                  <?php endif;?>
                </div>
              <?php endif; ?>
              <?php if($content['field_event_branding_toggle']): ?>
                <div class="grid-cell width--100 text-align--left md--width--70 padding-y--md">
                  <?php if (!empty($content['field_event_branding_title'])):?>
                    <h2 class="title caps padding-bottom--lg"><?php print render($content['field_event_branding_title']); ?></h2>
                  <?php endif;?>
                  <?php print render($content['field_event_nkf_text']); ?>
                  <?php if($content['field_event_local_text']): ?>
                  		<div class="padding-top--md">
		                    <?php print render($content['field_event_local_text']); ?>
                    </div>
                  <?php endif; ?>
                  <div class="padding-top--lg md--padding-top--xxl text-align--center md--text-align--left">
                    <?php foreach($ctas as $i => $cta): ?>
                      <a
                        class="button--gray-2 sm--width--auto width--100 margin-y--xxs sm--margin-right--xs caps"
                        href="<?php print $cta['url']; ?>">
                        <?php print $cta['title']; ?>
                      </a>
                    <?php endforeach;?>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="grid-cell md--width--33">
          </div>
        </div>
      </div>
    </section>
    <!-- SHARING AND BRANDING END -->

  </div>
</div>
