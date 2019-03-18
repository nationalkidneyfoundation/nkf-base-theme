<?php

/**
 * Implements of preprocess_page().
 */
function nkf_base_preprocess_page(&$vars) {

  $page_classes = array('page');
  $alias = strtolower(drupal_get_path_alias());
  $vars['th'] = nkf_base_color_theme_helper('standard');
  $vars['has_title'] = true;
  $vars['home'] = '';
  $vars['header_color'] = 'orange';
  $vars['nav_color'] = 'orange--l1';
  $vars['microsite'] = FALSE;

  if (!empty($vars['node'])) {
    $wrapper = entity_metadata_wrapper('node', $vars['node']);
    if (isset($wrapper->field_color_theme) && !empty($wrapper->field_color_theme->value()))
    $vars['th'] = nkf_base_color_theme_helper($wrapper->field_color_theme->value());
  }

  $microsites = array(
    'spring-clinical' => array(
      'paths' => array('spring-clinical'),
      'header_color' => 'aqua',
      'nav_color' => 'aqua--l1',
      'theme' => 'aqua',
    ),
    'support/kidneycars' => array(
      'paths' => array('kidneycars', 'support/kidneycars','blog/kidney-cars'),
      'header_color' => 'orange',
      'nav_color' => 'orange--l1',
      'theme' => 'orange',
    ),
    'golf' => array(
      'paths' => array('golf', 'events/golf', 'golfevents'),
      'header_color' => 'lime',
      'nav_color' => 'lime--l1',
      'theme' => 'lime',
    )
  );
  foreach ($microsites as $key => $value) {
    $is_microsite = array_filter($value['paths'], function ($haystack) {
      $alias = strtolower(drupal_get_path_alias());
      return(strpos($alias,$haystack) === 0);
    });
    if (!empty($is_microsite)) {
      $vars['microsite'] = TRUE;
      $vars['header_color'] = $value['header_color'];
      $vars['nav_color'] = $value['nav_color'];
      $vars['home'] = $key;
      $vars['th'] = nkf_base_color_theme_helper($value['theme']);
      break;
    }
  }
  // if we are dealing with Kidneycars add js
  if ($vars['home'] == 'support/kidneycars' && FALSE) {
    $g_tags = "(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
              })(window,document,'script','dataLayer','GTM-P3XGHNL');";
    drupal_add_js($g_tags,
      array('type' => 'inline', 'scope' => 'header')
    );
    drupal_add_js('https://a.remarketstats.com/px/smart/?c=2155a54adcacf52',
      array('type' => 'external', 'scope' => 'footer')
    );
    $vars['cars_noscript'] = '<!-- Google Tag Manager (noscript) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P3XGHNL"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <!-- End Google Tag Manager (noscript) -->';
  }

  // lets see if we are on a professionals page and add classes
  if (strpos($alias, 'professionals/membership') !== false) {
    $page_classes[] = 'page-professionals';
    $page_classes[] = 'page-professionals-membership';
  }

  if (strpos($alias, 'category') !== FALSE || strpos($alias, 'atoz') !== false && $alias != 'atoz') {
    $vars['title_prefix'] = '<a href="/atoz" class="display--inline-block caps bold padding-y--xs">A to Z Health Guide</a>';
  }


  $widescreen = false;

  $panel = panels_get_current_page_display();

  if (!$panel && !empty($vars['node']) && isset($vars['node']->panels_node) ) {
    $panel = panels_load_display($vars['node']->panels_node['did']);
  }
  if (isset($panel) && !empty($panel->layout) && $panel->layout == 'widescreen') {
    $widescreen = true;
  }
  $vars['widescreen'] = $widescreen;

  // Add home link back to spe profile home.
  if (strpos($alias, 'personalized-health-information') !== FALSE && !empty(arg(2))) {
    $profile_link = l('Profile Home', arg(0) . '/' . arg(1),
      array('attributes' => array('class' => array('display--inline-block','caps', 'bold', 'padding-y--xs')))
    );
    $vars['title_prefix'] = $profile_link;
  }

  // add magnific popup
  $magnificpath = libraries_get_path('magnific_popup');
  drupal_add_js($magnificpath . '/dist/jquery.magnific-popup.js');
  drupal_add_css($magnificpath . '/dist/magnific-popup.css');

  // add jquery.inputmask
  //$inputmask = libraries_get_path('inputmask');
  //drupal_add_js($inputmask . '/dist/min/inputmask/inputmask.min.js');
  //drupal_add_js($inputmask . '/dist/min/inputmask/inputmask.extensions.min.js');
  //drupal_add_js($inputmask . '/dist/min/inputmask/jquery.inputmask.min.js');

  // add jquery.payment
  $payment = libraries_get_path('jquery.payment');
  drupal_add_js($payment . '/lib/jquery.payment.min.js');

  // add ziptastic-jquery-plugin
  //$ziptastic = libraries_get_path('ziptastic-jquery-plugin');
  //drupal_add_js($ziptastic . '/jquery.ziptastic.js');



  $columns = 1;
  $columns += !empty($vars['page']['sidebar_first'])? 1 : 0;
  $columns += !empty($vars['page']['sidebar_second'])? 1 : 0;
  $vars['columns'] = $columns;
  if (
    !empty($vars['node'])
    && (
      (isset($vars['node']->field_donation_type) && !empty($vars['node']->field_donation_type[LANGUAGE_NONE][0]['redhen_donation_type']))
      ||
      (isset($vars['node']->field_membership_donation_type) && !empty($vars['node']->field_membership_donation_type[LANGUAGE_NONE][0]['redhen_donation_type']))
      )
    ) {
      $page_classes[] = 'has-donation-form';
  }

  if (!empty($vars['node']) && $vars['node']->type == 'new_event') {
    $vars['widescreen'] = true;
    $vars['has_title'] = false;
  }

  if (strpos($alias, 'golfevents') !== false) {
    //$vars['th'] = nkf_base_color_theme_helper('gray-5');
  }
  if (strpos($alias, 'iga-trial') !== false) {
    $vars['th'] = nkf_base_color_theme_helper('gray-5');
  }


  $vars['node_highlight'] = FALSE;
  $vars['node_highlight_text'] = '';
  $vars['background_image'] = FALSE;
  $vars['background_video'] = FALSE;
  if (!empty($vars['node'])
     && isset($vars['node']->field_hero_image_background)
     && isset($vars['node']->field_hero_image_background[LANGUAGE_NONE][0]['uri'])) {
       $image_uri = $vars['node']->field_hero_image_background[LANGUAGE_NONE][0]['uri'];
       $style = 'full_page_background';
       $derivative_uri = image_style_path($style, $image_uri);
       $success = file_exists($derivative_uri) || image_style_create_derivative(image_style_load($style), $image_uri, $derivative_uri);
       $new_image_url  = file_create_url($derivative_uri);
       $vars['background_image'] = true;
       $vars['background_image_uri'] =  $new_image_url;
       $vars['node_highlight'] = TRUE;
  }
  if (!empty($vars['node'])
     && isset($vars['node']->field_highlight_text)
     && isset($vars['node']->field_highlight_text[LANGUAGE_NONE][0]['value'])) {
       $h = field_view_field('node', $vars['node'], 'field_highlight_text', array('label' => 'hidden'));
       $vars['node_highlight_text'] = render($h);
       $vars['node_highlight'] = TRUE;
  }
  if (!empty($vars['node'])
     && isset($vars['node']->field_hero_video_background_mp4)
     && isset($vars['node']->field_hero_video_background_mp4[LANGUAGE_NONE][0]['value'])) {
       $vars['background_video_mp4'] = $vars['node']->field_hero_video_background_mp4[LANGUAGE_NONE][0]['value'];
       $vars['background_video'] = TRUE;
       $vars['node_highlight'] = TRUE;
  }
  if (!empty($vars['node'])
     && isset($vars['node']->field_hero_video_background_webm)
     && isset($vars['node']->field_hero_video_background_webm[LANGUAGE_NONE][0]['value'])) {
       $vars['background_video_webm'] = $vars['node']->field_hero_video_background_webm[LANGUAGE_NONE][0]['value'];
       $vars['background_video'] = TRUE;
       $vars['node_highlight'] = TRUE;
  }
  if (!empty($vars['node'])
     && isset($vars['node']->field_hero_video_background_ogg)
     && isset($vars['node']->field_hero_video_background_ogg[LANGUAGE_NONE][0]['value'])) {
       $vars['background_video_ogg'] = $vars['node']->field_hero_video_background_ogg[LANGUAGE_NONE][0]['value'];
       $vars['background_video'] = TRUE;
       $vars['node_highlight'] = TRUE;
  }
  if (!empty($vars['node'])
     && $vars['node']->type =='donation'
     && $vars['background_image']) {
       $vars['node_highlight'] = FALSE;
  }

  if (!isset($_SESSION['nkf_base'])) {
    $_SESSION['nkf_base'] = array();
  }
  $messages = _nkf_base_status_messages();
  if (!empty($messages['error'])) {
    $page_classes[] = 'errors';
  }
  if (!empty($messages['alert'])) {
    $page_classes[] = 'alert';
  }

  // hack to add slick to planned giving page.
  if (strpos($alias, 'planned-giving') !== false) {
    nkf_base_include_slick();
  }
  $vars['page_classes'] = implode(' ', $page_classes);
}


/**
 *
 */
function _nkf_base_status_messages() {
  $messages = array();
  foreach (drupal_get_messages(NULL, FALSE) as $type => $messages) {
    if (count($messages) > 1) {
      $messages[$type] = TRUE;
    }
  }
  return $messages;
}
