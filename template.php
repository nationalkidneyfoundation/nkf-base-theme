<?php


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

  // add magnific popup
  $magnificpath = libraries_get_path('magnific_popup');
  drupal_add_js($magnificpath . '/dist/jquery.magnific-popup.js');
  drupal_add_css($magnificpath . '/dist/magnific-popup.css');

  $columns = 1;
  $columns += !empty($vars['page']['sidebar_first'])? 1 : 0;
  $columns += !empty($vars['page']['sidebar_second'])? 1 : 0;
  $vars['columns'] = $columns;


  $vars['background_image'] = false;
  if(!empty($vars['node'])
     && isset($vars['node']->field_hero_image_background)
     && isset($vars['node']->field_hero_image_background[LANGUAGE_NONE][0]['uri'])) {
       $vars['background_image'] = true;
       $vars['background_image_uri'] = file_create_url($vars['node']->field_hero_image_background[LANGUAGE_NONE][0]['uri']);
       //image_style_url('full_page_background', $vars['node']->field_hero_image_background['LANGUAGE_NONE'][0]['uri']);
  }

  $page_classes = array('page');
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
  //print '<pre>';
  //print_r($variables);
  //print '</pre>';
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
