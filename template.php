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

/**
 * Implementation of preprocess_page().
 */
function nkf_base_preprocess_page(&$vars) {
  $page_classes = array('page');
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
 if (!empty($vars['node'])
    && (isset($vars['node']->field_donation_type) || isset($vars['node']->field_membership_donation_type))) {
      $page_classes[] = 'donation-form';
 }

  $vars['node_highlight'] = FALSE;
  $vars['node_highlight_text'] = '';
  $vars['background_image'] = FALSE;
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
       $vars['node_highlight_text'] = $vars['node']->field_highlight_text;
       $vars['node_highlight'] = TRUE;
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
    $bean = $beans[reset(element_children($beans))];
    // Add template suggestions for bean types.
    $vars['theme_hook_suggestions'][] = 'block__bean__' . $bean['#bundle'];
  }
}
/**
 * Override or insert variables into the bean templates.
 */
function nkf_base_preprocess_entity(&$vars) {
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
  return '<ul class="menu ' . _get_menu_name_css($variables) . '">' . $variables['tree'] . '</ul>';
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

  if ($element ['#original_link']['menu_name'] == 'menu-nav-primary') {
    //$element ['#title'] = '<div>' . $element ['#title'] . '</div>';
    //$element ['#title'] .= '<div class="etc">' . $element ['#localized_options'] ['attributes'] ['title'] .'</div>';
    //$element ['#localized_options']['html'] = TRUE;
  }
  $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);
  return '<li' . drupal_attributes($element ['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Preprocess variables for panels_pane.tpl.php
 */
function nkf_base_preprocess_panels_pane(&$vars) {
  // Add id and custom class if sent in.

  if ($vars['display']->layout == 'flex') {
    $vars['classes_array'][] = 'grid-cell';
  }
}
