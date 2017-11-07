<?php

// Define theme directory path
define('NKF_BASE_PATH', drupal_get_path('theme', 'nkf_base'));

/**
 * Implementation of hook_form_alter
 */

function nkf_base_form_alter(&$form, &$form_state, $form_id) {
  if($form_id == 'views_exposed_form'){// && $form['#id'] == 'views-exposed-form-search-results-subsection-page') {
    $view = $form_state['view'];
    if ($view->name == 'search_results_subsection' || $view->name == 'new_events') {
      $form['search']['#attributes'] =
        array(
          'class' => array('width--100'),
      );
      $form['submit']['#attributes'] =
        array(
          'class' => array('width--100', 'button--gray-4'),
      );
    }
  }
}

/**
 * Implementation of hook_addressfield_administrative_areas_alter
 * force all US stats to be abbreviations.
 */
function nkf_base_addressfield_administrative_areas_alter(&$adminstrative_areas) {
  foreach ($adminstrative_areas['US'] as $key => $value) {
    $adminstrative_areas['US'][$key] = $key;
  }
}


function nkf_base_css_alter(&$css) {
  $exclude = array(
    'profiles/kidneys_distro/modules/contrib/commerce/modules/payment/theme/commerce_payment.theme.css' => FALSE,
    'profiles/kidneys_distro/modules/contrib/addtocal/addtocal.css' => FALSE,
    'profiles/kidneys_distro/modules/contrib/field_collection/field_collection.theme.css' => FALSE,
    'profiles/kidneys_distro/modules/contrib/geofield/css/proximity-element.css' => FALSE,
  );
  $css = array_diff_key($css, $exclude);
}

/**
 * Implementation of hook_js_alter().
 * get rid of all css cruft
 */
function nkf_base_js_alter(&$js) {
  $exclude = array(
    'profiles/kidneys_distro/modules/contrib/addtocal/addtocal.js' => FALSE,
  );
  $js = array_diff_key($js, $exclude);
}


/**
 * hook_field_attach_view_alter
 * make addtocal a modal
 */
function nkf_base_field_attach_view_alter(&$output, $context) {
  reset($output);
  $field_name = key($output);
  if (!empty($output[$field_name]) && !empty($output[$field_name]['#formatter']) && $formatter = $output[$field_name]['#formatter'] == 'addtocal_view' && !empty($output[$field_name][0])) {
    // remove css and js
    unset($output[$field_name][0]['#attached']);
    // add modal classes
    $id = $output[$field_name][0]['menu']['#attributes']['id'];
    unset($output[$field_name][0]['menu']['#attributes']);
    foreach($output[$field_name][0]['menu']['#items'] as $i => $v) {
      $output[$field_name][0]['menu']['#items'][$i] = '<div class="padding-y--xxs font-size--lg">' . $output[$field_name][0]['menu']['#items'][$i] . '</div>';
    }
    $output[$field_name][0]['menu']['#attributes']['class'] = 'list--reset';
    $output[$field_name][0]['button']['#markup'] = '<a href="#' . $id . '-modal" class="modal-trigger">Add to Calendar</a>';
    $output[$field_name][0]['modal']['#type'] = 'container';
    $output[$field_name][0]['modal']['#attributes']['class'] = 'display--table modal mfp-hide sm--width--xxl bg--white padding-x--xxl padding-bottom--xxl center';
    $output[$field_name][0]['modal']['#attributes']['id'] = $id . '-modal';
    $output[$field_name][0]['modal']['title']['#markup'] = '<h3 class="caps">Add to Calendar</h3>';
    $output[$field_name][0]['modal']['title']['#weight'] = -10;
    $output[$field_name][0]['modal']['menu'] = $output[$field_name][0]['menu'];
    unset($output[$field_name][0]['menu']);
  }
}


function nkf_base_preprocess_node(&$vars) {
  $node = $vars['node'];
  $wrapper = entity_metadata_wrapper('node', $node);

  $vars['section_classes'] = '';
  $vars['hero_classes'] = '';
  if (isset($wrapper->field_color_theme) && !empty($wrapper->field_color_theme->value())) {
    $vars['th'] = nkf_base_color_theme_helper($wrapper->field_color_theme->value());
  }
  if ($vars['type'] == 'panel') {
    if ($vars['content_attributes_array'] && $vars['content_attributes_array']['class']) {
      $vars['content_attributes_array']['class'] = array_diff($vars['content_attributes_array']['class'], array('prose'));
    }
  }

  if ($vars['type'] == 'new_event') {

    // Sticky Nav.
    $vars['sections'] = array(
      'top' => array(
        'include' => true,
        'title' => 'Top'
      ),
      'about' => array(
        'include' => true,
        'title' => 'About This Event'
      ),
      'vip1' => array(
        'include' => $wrapper->field_event_vip1_toggle->value(),
        'title' => $wrapper->field_event_vip1_title->value()
      ),
      'vip2' => array(
        'include' => $wrapper->field_event_vip2_toggle->value(),
        'title' => $wrapper->field_event_vip2_title->value()
      ),
      'vip3' => array(
        'include' => $wrapper->field_event_vip3_toggle->value(),
        'title' => $wrapper->field_event_vip3_title->value()
      ),
      'auction' => array(
        'include' => $wrapper->field_event_auction_toggle->value(),
        'title' => $wrapper->field_event_auction_title->value()
      ),
      'location' => array(
        'include' => $wrapper->field_event_location_toggle->value(),
        'title' => $wrapper->field_event_location_title->value()
      ),
      'volunteer' => array(
        'include' => $wrapper->field_event_volunteer_toggle->value(),
        'title' => $wrapper->field_event_volunteer_title->value(),
      ),
      'photos' => array(
        'include' => $wrapper->field_event_photos_toggle->value(),
        'title' => $wrapper->field_event_photos_title->value()
      ),
      'aboutnkf' => array(
        'include' => true,
        'title' => $wrapper->field_event_branding_title->value()
      ),
    );


    if (isset($wrapper->field_event_hero_image) && !empty($wrapper->field_event_hero_image->value())) {
      //$hero_style = array(
      //  'image_scale' => array()
      //);
      $vars['hero_url'] = nkf_base_get_image_style_url($wrapper->field_event_hero_image->value()['uri'], 'extra_large_landscape');
      //print '<pre>';
      //print_r(image_style_load('large'));
      //print '</pre>';
    }
    if (isset($wrapper->field_base_address)) {
      $vars['city'] = $wrapper->field_base_address->locality->value();
      $vars['state'] = $wrapper->field_base_address->administrative_area->value();
      $vars['zip'] = $wrapper->field_base_address->postal_code->value();
      $vars['street'] = $wrapper->field_base_address->thoroughfare->value();
      $vars['street2'] = $wrapper->field_base_address->premise->value();
      $vars['address_url'] = urlencode($vars['street'] . ' ' . $vars['city'] . ' ' . $vars['state'] . ' ' . $vars['zip']);
    }
    if (isset($wrapper->field_base_geofield) && isset($wrapper->field_base_geofield->lon)) {
      $vars['longitude'] = $wrapper->field_base_geofield->lon->value();
      $vars['latitude'] = $wrapper->field_base_geofield->lat->value();
    }

    if (isset($wrapper->field_event_cta) && !empty($wrapper->field_event_cta->value())) {
      foreach ($wrapper->field_event_cta as $i => $cta) {
        $vars['ctas'][] = array(
          'url' => $cta->url->value(),
          'title' => $cta->title->value(),
          'button' => ($i == 0) ? $vars['th']['header_button_1'] : $vars['th']['header_button_2']
        );
      }
    }

    if (module_exists('kidneys_misc')) {
      $vars['social_actions'] = kidneys_misc_get_content_actions();
    }
    /*
    if (isset($wrapper->field_event_vip_1) && !empty($wrapper->field_event_vip_1->value())) {
      foreach ($wrapper->field_event_vip_1 as $key => $value) {
        $vars['photos'][] = array(
          'src_thumb' => nkf_base_get_image_style_url($value->value()['uri'], 'square_thumbnail'),
          'src_full' => nkf_base_get_image_style_url($value->value()['uri']),
          'title' => $value->value()['title'],
          'alt' => $value->value()['alt'],
        );
      }
    }
    */

    if (isset($wrapper->field_event_event_photos1) && !empty($wrapper->field_event_event_photos1->value())) {
      foreach ($wrapper->field_event_event_photos1 as $key => $value) {
        $vars['photos'][] = array(
          'src_thumb' => nkf_base_get_image_style_url($value->value()['uri'], 'square_thumbnail'),
          'src_full' => nkf_base_get_image_style_url($value->value()['uri']),
          'title' => $value->value()['title'],
          'alt' => $value->value()['alt'],
        );
      }
    }

    if (isset($wrapper->field_event_header_font) && !empty($wrapper->field_event_header_font->value())) {
      $header_font = $wrapper->field_event_header_font->value();
      $header_font_url = str_replace(' ','+', $header_font);
      $css = '@import url("https://fonts.googleapis.com/css?family=' . $header_font_url . '");';
      $css .= 'h1,h2,h3,h4 { font-family: ' . $header_font . ' !important; font-weight: normal !important}';
      drupal_add_css($css, 'inline');
    }

    if (isset($wrapper->field_base_hero_divider) && !empty($wrapper->field_base_hero_divider->value())) {
      $vars['hero_classes'] .= $wrapper->field_base_hero_divider->value();
    }
    if (isset($wrapper->field_base_section_divider) && !empty($wrapper->field_base_section_divider->value())) {
      if (isset($wrapper->field_color_theme) && !empty($wrapper->field_color_theme->value())) {
        $svg_color = nkf_base_color_hex_from_name($wrapper->field_color_theme->value());
      } else {
        $svg_color = nkf_base_color_hex_from_name();
      }
      $vars['section_classes'] .= 'edge--icon--bottom';
      $icon_name = $wrapper->field_base_section_divider->value();
      $svg_file = file_get_contents(NKF_BASE_PATH . "/svg/$icon_name.svg");
      $svg_file = trim($svg_file);
      $svg_file = str_replace(array("\n", "\t", "\r"), '', $svg_file);
      $svg_url = 'data:image/svg+xml;utf8,' . str_replace('<svg','<svg fill="'.$svg_color.'"',$svg_file);
      $css = '.edge--icon--bottom:after { background-image: url(\'' . $svg_url . '\'); }';
      drupal_add_css($css, 'inline');
    }

    $vars['has_nav_sub'] = true;
    $vars['sub_nav_title'] = $node->title;
    $vars['sub_nav_actions'] = $vars['social_actions'];

  }


}

function nkf_base_color_hex_from_name($name = 'gray-2') {
  $colors = array(
      'orange' =>     '#F15E22'
    , 'blue' =>       '#1E4497'
    , 'navy' =>       '#26225E'
    , 'red' =>        '#d51217'
    , 'mustard' =>    '#FAAD1D'
    , 'aqua' =>       '#048499'
    , 'yellow' =>     '#FEDC00'
    , 'green' =>      '#018241'
    , 'lime' =>       '#91AE3C'
    , 'sienna' =>     '#9E2420'
    , 'gray-2' =>     '#DBDDDF'
  );
  return $colors[$name];
}
function nkf_base_color_theme_helper($name) {
  $themes = array (
    'standard' => array(
      'primary_color' => 'orange',
      'header' => 'bg--orange color--white logo--wb',
      'hero' => 'bg--gray-1 color--gray-4',
      'odd_section' => 'bg--gray-1',
      'header_button_1' => 'button--orange',
      'header_button_2' => 'button--gray-2',
    ),
    'orange' => array(
      'primary_color' => 'orange',
      'header' => 'bg--orange color--white logo--wb',
      'hero' => 'bg--orange--l1 color--white',
      'odd_section' => 'bg--orange--l2',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--orange',
    ),
    'blue' => array(
      'primary_color' => 'blue',
      'header' => 'bg--blue color--white logo--w',
      'hero' => 'bg--blue--l1 color--white',
      'odd_section' => 'bg--blue--o20',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--blue'
    ),
    'navy' => array(
      'primary_color' => 'navy',
      'header' => 'bg--navy color--white logo--w',
      'hero' => 'bg--navy--l1 color--white',
      'odd_section' => 'bg--navy--o20 color--navy',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--navy'
    ),
    'mustard' => array(
      'primary_color' => 'mustard',
      'header' => 'bg--mustard color--white logo--w',
      'hero' => 'bg--mustard--l1 color--white',
      'odd_section' => 'bg--mustard--o20 color--gray-4',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--mustard'
    ),
    'aqua' => array(
      'primary_color' => 'aqua',
      'header' => 'bg--aqua color--white logo--w',
      'hero' => 'bg--aqua--l1 color--white',
      'odd_section' => 'bg--aqua--o20 color--gray-4',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--aqua'
    ),
    'red' => array(
      'primary_color' => 'red',
      'header' => 'bg--red color--white logo--w',
      'hero' => 'bg--red--l1 color--white',
      'odd_section' => 'bg--red--o20 color--gray-4',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--red'
    ),
  );
  return $themes[$name];
}

/**
 * Implementation of preprocess_page().
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
  $microsites = array(
    'spring-clinical' => array(
      'paths' => array('spring-clinical'),
      'header_color' => 'aqua',
      'nav_color' => 'aqua--l1'
    ),
    'support/kidneycars' => array(
      'paths' => array('kidneycars', 'support/kidneycars','blog/kidney-cars'),
      'header_color' => 'orange',
      'nav_color' => 'orange--l1'
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
      break;
    }
  }
  // if we are dealing with Kidneycars add js
  if ($vars['home'] == 'support/kidneycars') {
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

  if (!empty($vars['node'])) {
    $wrapper = entity_metadata_wrapper('node', $vars['node']);
    if (isset($wrapper->field_color_theme) && !empty($wrapper->field_color_theme->value()))
    $vars['th'] = nkf_base_color_theme_helper($wrapper->field_color_theme->value());
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
  $vars['page_classes'] = implode(' ', $page_classes);
}

/**
 * Override or insert variables into the block templates.
 */
function nkf_base_preprocess_block(&$vars) {

  if ($vars['block']->module == 'bean') {
    $beans = $vars['elements']['bean'];
    // There is only 1 bean per block.
    $b = element_children($beans);
    $b = reset($b);
    $bean = $beans[$b];
    // Add template suggestions for bean types.
    $vars['theme_hook_suggestions'][] = 'block__bean__' . $bean['#bundle'];
  }
}
/**
 * Override or insert variables into the bean templates.
 */
function nkf_base_preprocess_entity(&$vars) {
  // Add generic preprocessing.
  if (isset($vars['entity_type']) && isset($vars[$vars['entity_type']]->type)) {
    $function = __FUNCTION__ . '_' . $vars['entity_type'] . '_' . $vars[$vars['entity_type']]->type;
    if (function_exists($function)) {
      $function($vars);
    }
  }
  if ($vars['entity_type'] == 'bean') {
    if ($vars['bean']->type == 'banner') {
      $vars['background_image'] = false;
      if (isset($vars['bean']->field_hero_image_background)
         && isset($vars['bean']->field_hero_image_background[LANGUAGE_NONE][0]['uri'])) {
           $image_uri = $vars['bean']->field_hero_image_background[LANGUAGE_NONE][0]['uri'];
           $style = 'full_page_background';
           $derivative_uri = image_style_path($style, $image_uri);
           $success = file_exists($derivative_uri) || image_style_create_derivative(image_style_load($style), $image_uri, $derivative_uri);
           $new_image_url  = file_create_url($derivative_uri);
           $vars['background_image'] = TRUE;
           $vars['background_image_uri'] =  $new_image_url;
      }
    }
  }
}
function nkf_base_preprocess_entity_bean_hero(&$vars) {
  $type= $vars['entity_type'];

  $horientation = $vars[$type]->field_hero_horientation[LANGUAGE_NONE][0]['value'];
  $vorientation = $vars[$type]->field_hero_vorientation[LANGUAGE_NONE][0]['value'];
  $height = $vars['height'] = $vars[$type]->field_hero_height[LANGUAGE_NONE][0]['value'];

  $description = $vars[$type]->field_base_description[LANGUAGE_NONE][0];
  $description = field_view_value('bean', $vars['bean'], 'field_base_description', $description);
  $vars['description'] = render($description);

  if($image = $vars[$type]->field_base_image[LANGUAGE_NONE][0]['uri']) {
    $image_style = 'hero';
    $media_uri = $image;
    $vars['media_uri'] = nkf_base_get_image_style_url($media_uri, $image_style);
  }

  $content_classes = array();
  $content_classes[] = $horientation;
  $content_classes[] = $vorientation;
  $vars['content_classes'] = implode(' ', $content_classes);

}

function nkf_base_preprocess_entity_bean_card(&$vars) {
  $type= $vars['entity_type'];

  $vars['media_orientation'] = $media_orientation = (!empty($vars[$type]->field_card_media_orientation[LANGUAGE_NONE])) ? $vars[$type]->field_card_media_orientation[LANGUAGE_NONE][0]['value'] : FALSE;
  $vars['media_size'] = $media_size = (!empty($vars[$type]->field_card_media_size[LANGUAGE_NONE])) ? $vars[$type]->field_card_media_size[LANGUAGE_NONE][0]['value'] : FALSE;
  $vars['height'] = $height = (!empty($vars[$type]->field_card_height[LANGUAGE_NONE])) ? $vars[$type]->field_card_height[LANGUAGE_NONE][0]['value'] : FALSE;
  $vars['url'] = $url = (!empty($vars[$type]->field_base_link[LANGUAGE_NONE])) ? $vars[$type]->field_base_link[LANGUAGE_NONE][0]['url'] : FALSE;

  if (isset($vars[$type]->field_card_action_links[LANGUAGE_NONE])) {
    $_d = count($vars[$type]->field_card_action_links[LANGUAGE_NONE]);
  }
  $_d = 1;
  $vars['action_links_width'] = floor((1 / $_d) * 100);

  $vars['bg_color'] = $bg_color = (!empty($vars[$type]->field_card_bg_color[LANGUAGE_NONE])) ? $vars[$type]->field_card_bg_color[LANGUAGE_NONE][0]['value'] : FALSE;
  $vars['text_color'] = $text_color = (preg_match('/gray-5|blue|navy|red|aqua|green|sienna/', $bg_color))? 'white' : 'black';

  $vars['action_links'] = array();
  if (!empty($vars[$type]->field_card_action_links[LANGUAGE_NONE])) {
    foreach($vars[$type]->field_card_action_links[LANGUAGE_NONE] as $l) {
      $l['attributes']['class'][] = 'color--' . $text_color;
      $l['attributes']['class'][] = 'display--block';
      $l['attributes']['class'][] = 'padding--sm';
      $vars['action_links'][] = l($l['title'], $l['url'], $l);
    }
  }

  $title = render($vars[$type]->title);
  $vars['title'] = $title;

  $description = (!empty($vars[$type]->field_base_description[LANGUAGE_NONE])) ? $vars[$type]->field_base_description[LANGUAGE_NONE][0] : FALSE;
  if ($description) {
    $d = field_view_value('bean', $vars['bean'], 'field_base_description', $description);
    $description = render($d);
    $vars['description'] = $description;
  }


  if(!empty($vars[$type]->field_base_image[LANGUAGE_NONE]) && $image = $vars[$type]->field_base_image[LANGUAGE_NONE][0]['uri']) {
    $media_uri = $image;
  }

  if(!empty($vars[$type]->field_card_video[LANGUAGE_NONE]) && $video = $vars[$type]->field_card_video[LANGUAGE_NONE][0]) {
    $video_settings = array('type'=>'video_embed_field_thumbnail');
    $video_info = field_view_value('bean', $vars['bean'], 'field_card_video', $video, $video_settings);
    $_v = field_view_value('bean', $vars['bean'], 'field_card_video', $video);
    $video_embed = render($_v);
    $vars['video_embed'] = $video_embed;
    $media_uri = $video_info['#item']['uri'];
    //$vars['video'] = render(field_view_value('bean', $vars['bean'], 'field_card_video', $video, $video_settings));
  }

  if (!empty($vars[$type]->field_card_caption[LANGUAGE_NONE]) && $caption = $vars[$type]->field_card_caption[LANGUAGE_NONE][0]) {
    $_c = field_view_value('bean', $vars['bean'], 'field_card_caption', $caption);
    $vars['caption'] = render($_c);
  }


  $media_classes = array();
  $content_classes = array();
  $vars['flavor'] = 'media-top';
  if (!empty($media_uri)) {
    if ($media_orientation == 'l' || $media_orientation == 'r') {
      $media_classes[] = 'height--100';
      $media_classes[] = 'width--' . $media_size;
      $vars['flavor'] = ($media_orientation == 'l') ? 'media-left' : 'media-right';
      if(preg_match('/lg|xl/',$media_size)) {
        $image_style = 'card-standard';
      } else if($media_size == 'md') {
        $image_style = 'card-standard';
      } else if ($media_size == 'sm'){
        $image_style = 'card-portrait';
      }
    } else {
      $media_classes[] = 'width--100';
      $media_classes[] = 'height--' . $media_size;
      $vars['flavor'] = ($media_orientation == 't') ? 'media-top' : 'media-bottom';
      if(preg_match('/lg|xl/',$media_size)) {
        $image_style = 'card-standard';
      } else if($media_size == 'md') {
        $image_style = 'card-landscape';
      } else if ($media_size == 'sm'){
        $image_style = 'card-landscape';
      }
    }
    $vars['media_uri'] = nkf_base_get_image_style_url($media_uri, $image_style);
  }

  //$vars['media'] = $media;
  $vars['classes_plus'] = array();
  $vars['classes_plus'][] = 'bg--' . $bg_color;
  $vars['classes_plus'][] = 'color--' . $text_color;




  if ($height) {
    $vars['classes_plus'][] = 'height--' . $height;
  }

  $vars['classes_plus'] = implode(' ', $vars['classes_plus']);
  $vars['media_classes'] = implode(' ', $media_classes);
  $vars['random'] = user_password();

}

function nkf_base_get_image_style_url($image_uri, $style = 'large') {
  $derivative_uri = image_style_path($style, $image_uri);
  if (!file_exists($derivative_uri)) {
    image_style_create_derivative(image_style_load($style), $image_uri, $derivative_uri);
  }
  return file_create_url($derivative_uri);
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

/**
 * hook_menu_tree
 */
function nkf_base_menu_tree($variables) {
  //watchdog('nkf_base_teplate', '<pre>' . print_r($variables,TRUE) . '</pre>');
  $name = _get_menu_name_css($variables);
  if (strpos($name, 'cta') !== FALSE || strpos($name, 'cars') !== FALSE) {
    return $variables['tree'];
  }
  return '<ul class="menu ' . _get_menu_name_css($variables) . '">' . $variables['tree'] . '</ul>';

}
function nkf_base_menu_tree__menu_scm_new($variables) {
  return $variables['tree'];
}
function nkf_base_menu_tree__menu_scm_cta($variables) {
  return $variables['tree'];
}
function nkf_base_menu_tree__menu_scm_primary_nav($variables) {
  return $variables['tree'];
}

/*
function nkf_base_menu_tree__sub_menu($variables) {
  return '<ul class="menu sub-menu ' . _get_menu_name_css($variables) . '">' . $variables['tree'] . '</ul>';

}*/
function _get_menu_name_css($variables) {

  $menu_name = str_replace('menu_tree__', '', $variables['theme_hook_original']);
  $menu_name = drupal_clean_css_identifier($menu_name);
  return $menu_name;
}
/**
 * hook_menu_link
 */

function nkf_base_menu_link(array $variables) {

  $element = $variables ['element'];
  $sub_menu = '';

  if ($element ['#below']) {
    $element ['#below']['#theme_wrappers'][] = 'menu_tree__menu_sub';
    $sub_menu = drupal_render($element ['#below']);
  }
  $name = $element ['#original_link']['menu_name'];
  if ($name == 'menu-scm-new' || $name == 'menu-scm-primary-nav' || strpos($name, 'cars') !== FALSE) {
    $element ['#localized_options']['attributes']['class'][] = 'padding-y--xxs';
    $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);
    $element ['#attributes']['class'][] = 'grid-cell width--100 vertical-align--middle';
    return '<div' . drupal_attributes($element ['#attributes']) . '>' . $output . "</div>\n";
  }
  //if ($element ['#original_link']['menu_name'] == 'menu-scm-cta') {
  if (strpos($element ['#original_link']['menu_name'] , 'cta') !== false) {
    $element ['#localized_options']['attributes']['class'][] = 'button--mustard caps white-space--nowrap';
    $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);
    $element ['#attributes']['class'][] = '';
    return $output . $sub_menu ;
    return '<div' . drupal_attributes($element ['#attributes']) . '>' . $output . $sub_menu . "</div>\n";
  }
  $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);
  return '<li' . drupal_attributes($element ['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Preprocess variables for panels_pane.tpl.php
 */
function nkf_base_preprocess_panels_pane(&$vars) {
  // Add id and custom class if sent in.

  if ($vars['display']->layout == 'flex' || $vars['display']->layout == 'flex-center' || $vars['display']->layout == 'widescreen') {
    $vars['classes_array'][] = 'grid-cell';
  }
}


function nkf_base_version_2_allowed_pages($path) {
  $patterns = theme_get_setting('nkf_base_version_2_paths');
  if (drupal_match_path($path, $patterns)) {
    return TRUE;
  }
}

function nkf_base_preprocess_field(&$vars, $hook){
  if ($vars['element']['#field_type'] == 'field_collection') {
    $fields = field_info_instances('field_collection_item', $vars['element']['#field_name']);
    $field_array = array_keys($fields);
    nkf_base_rows_from_field_collection($vars, $field_array);
    if (in_array($vars['element']['#field_name'], array('field_event_vip_1','field_event_vip_2', 'field_event_vip_3'))) {
      $groups = array();
      foreach($vars['rows'] as $row) {
        $groups[strtoupper($row['field_vip_subsection_text'])][] = $row;
      }
      $vars['rows'] = $groups;
    }
  }
}


/**
 * Creates a simple text rows array from a field collections, to be used in a
 * field_preprocess function.
 * https://www.fourkitchens.com/blog/article/better-way-theme-field-collections/
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 *
 * @param $field_name
 *   The name of the field being altered.
 *
 * @param $field_array
 *   Array of fields to be turned into rows in the field collection.
 */

function nkf_base_rows_from_field_collection(&$vars, $field_array) {
  $vars['rows'] = array();
  foreach($vars['element']['#items'] as $key => $item) {
    $entity_id = $item['value'];
    $entity = field_collection_item_load($entity_id);
    $wrapper = entity_metadata_wrapper('field_collection_item', $entity);
    $row = array();
    foreach($field_array as $field) {
      $info = $wrapper->$field->info();
      $type = $info['type'];
      //field_item_link
      $field_value = $wrapper->$field->value();
      switch ($type) {
        case 'text_formatted':
          $value = $wrapper->$field->value->value();
          break;
        case 'field_item_image':
          if (isset($field_value)) {

            $build = array(
              '#theme' => 'image',
              '#path' => $field_value['uri'],
              '#url' => nkf_base_get_image_style_url($field_value['uri'], 'large'),
              '#alt' => $field_value['alt'],
              '#title' => $field_value['title'],
              //'#width' => $field_value['width'],
              //'#height' => $field_value['height'],
            );
            $value = $build;
          } else {
            $value = null;
          }
          break;
        default:
          $value = isset($field_value) ? $wrapper->$field->value() : null;

      }
      $row[$field] = $value;
    }
    $vars['rows'][] = $row;
  }
}
