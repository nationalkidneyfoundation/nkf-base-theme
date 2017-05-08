<?php


 /**
  * Implements hook_theme().
  */

//function nkf_base_theme($existing, $type, $theme, $path) {
//  $items = array();
  //$items['redhen_donation_form'] = array(
  //  'render element' => 'form',
  //  'template' => 'donate-form',
  //  'path' => drupal_get_path('theme', 'nkf_base') . '/templates',
  //);
  //return $items;
//}


/**
 * Implementation of hook_form_alter
 */

function nkf_base_form_alter(&$form, &$form_state, $form_id) {
  if($form_id == 'views_exposed_form'){// && $form['#id'] == 'views-exposed-form-search-results-subsection-page') {
    $view = $form_state['view'];
    if ($view->name == 'search_results_subsection') {
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
  );
  $css = array_diff_key($css, $exclude);
}


function nkf_base_preprocess_node(&$vars) {
  if ($vars['type'] == 'panel') {
    if ($vars['content_attributes_array'] && $vars['content_attributes_array']['class']) {
      $vars['content_attributes_array']['class'] = array_diff($vars['content_attributes_array']['class'], array('prose'));
    }
  }

}
/**
 * Implementation of preprocess_page().
 */
function nkf_base_preprocess_page(&$vars) {
  $page_classes = array('page');
  $vars['home'] = '';
  // lets see if we are on a professionals page and add classes
  $alias = strtolower(drupal_get_path_alias());
  if (strpos($alias, 'professionals/membership') !== false) {
    $page_classes[] = 'page-professionals';
    $page_classes[] = 'page-professionals-membership';
  }

  $vars['microsite_home'] = FALSE;
  $vars['microsite_path'] = '';
  $vars['microsite_name'] = '';
  $vars['v2'] = FALSE;
  $vars['microsite_header_color'] = 'orange';
  $vars['microsite_band_color'] = 'mustard';

  $microsites = array(
    //'scm' => '2017 Spring Clinical Meetings',
    'spring-clinical' => '2017 Spring Clinical Meetings',
    //'transplantation/livingdonors' => FALSE,
    //'kidneycars' => 'Kidney Cars'
  );
  if ($alias == 'support' || $alias == 'support-nkf' || strpos($alias, 'latest-news') !== false || strpos($alias, 'atoz') !== false || strpos($alias, 'category') !== false || strpos($alias, 'transplantation/livingdonors') !== false) {
    $vars['v2'] = TRUE;
    if (strpos($alias, 'category') !== FALSE || strpos($alias, 'atoz') !== false && $alias != 'atoz') {
      $vars['title_prefix'] = '<a href="/atoz" class="display--inline-block caps bold padding-y--xs">A to Z Health Guide</a>';
    }
  }
  foreach ($microsites as $key => $value) {
    if (strpos($alias, $key) !== false) {
      $vars['v2'] = TRUE;
      //$vars['microsite_name'] = $value;
      $attributes = array(
        'attributes' => array('class' => array('color--black padding--xs display--block'))
      );
      $vars['microsite_path'] = l($value, $key, $attributes);
      $vars['home'] = $key;
      if ($alias == $key) {
        $vars['microsite_home'] = TRUE;
        $vars['microsite_path'] = l('www.kidney.org', 'http://www.kidney.org', $attributes);
        $vars['microsite_name'] = 'www.kidney.org';
      }
    }
  }
  if (strpos($alias, 'spring-clinical') !== false ) {
    $vars['microsite_header_color'] = 'aqua';
    $vars['microsite_band_color'] = 'mustard';
  }

  if (nkf_base_version_2_allowed_pages(current_path()) || nkf_base_version_2_allowed_pages(strtolower(drupal_get_path_alias()))) {
    $vars['v2'] = TRUE;
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

function nkf_base_get_image_style_url($image_uri, $style) {
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
  if (strpos($name, 'cta') !== FALSE) {
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

  if ($element ['#original_link']['menu_name'] == 'menu-scm-new' || $element ['#original_link']['menu_name'] == 'menu-scm-primary-nav') {
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
