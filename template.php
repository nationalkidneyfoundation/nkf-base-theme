<?php

// Define theme directory path
define('NKF_BASE_PATH', drupal_get_path('theme', 'nkf_base'));



// Theme includes
require_once NKF_BASE_PATH . '/includes/preprocess.inc';
require_once NKF_BASE_PATH . '/includes/helpers.inc';
require_once NKF_BASE_PATH . '/includes/form.inc';


/**
 * Implements hook_library().
 */
function nkf_base_library() {
  $library    = libraries_get_path('slick');

  $libraries['slick'] = array(
    'title' => 'Slick',
    'website' => 'http://kenwheeler.github.io/slick/',
    'version' => '1.x',
    'js' => array(
      $library . '/slick/slick.min.js'  => array(),
    ),
    'css' => array(
      $library . '/slick/slick.css' => array(),
    ),
  );

  return $libraries;
}

/*
 * Implementation of hook_theme.
 */
function nkf_base_theme($existing, $type, $theme, $path){
  return array(
    'card_pic_date' => array(
      'template' => 'card-pic-date',
      'path' => NKF_BASE_PATH . '/templates/cards',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
      ),
    ),
  );
}


/**
 * Force all US stats to be abbreviations.
 *
 * Implementats of hook_addressfield_administrative_areas_alter
 */
function nkf_base_addressfield_administrative_areas_alter(&$adminstrative_areas) {
  foreach ($adminstrative_areas['US'] as $key => $value) {
    $adminstrative_areas['US'][$key] = $key;
  }
}

/**
 * Get rid of some silly css.
 *
 * Implements hook_css_alter().
 */
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
 * Get rid of some annoying js.
 * Implements of hook_js_alter().
 */
function nkf_base_js_alter(&$js) {
  $exclude = array(
    'profiles/kidneys_distro/modules/contrib/addtocal/addtocal.js' => FALSE,
  );
  $js = array_diff_key($js, $exclude);
}


/**
 * Make addtocal a popup.
 * Currently this module does not work so consider ditching this.
 *
 * Implements hook_field_attach_view_alter
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


/**
 * hook_menu_tree
 */
function nkf_base_menu_tree($variables) {
  $name = _get_menu_name_css($variables);
  if (strpos($name, 'cta') !== FALSE || strpos($name, 'cars') !== FALSE || strpos($name, 'golf') !== FALSE) {
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
  if ($name == 'menu-scm-new' ||
      $name == 'menu-scm-primary-nav' ||
      strpos($name, 'cars') !== FALSE ||
      strpos($name, 'golf') !== FALSE
    ) {
    $element ['#localized_options']['attributes']['class'][] = 'padding-y--xxs';
    $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);
    $element ['#attributes']['class'][] = 'grid-cell width--100 vertical-align--middle';
    return '<div' . drupal_attributes($element ['#attributes']) . '>' . $output . "</div>\n";
  }
  //if ($element ['#original_link']['menu_name'] == 'menu-scm-cta') {
  if (strpos($element ['#original_link']['menu_name'] , 'cta') !== false) {
    $element ['#localized_options']['attributes']['class'][] = 'button--white caps white-space--nowrap';
    $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);
    $element ['#attributes']['class'][] = '';
    return $output . $sub_menu ;
    return '<div' . drupal_attributes($element ['#attributes']) . '>' . $output . $sub_menu . "</div>\n";
  }
  $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);
  return '<li' . drupal_attributes($element ['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}


/* DEPRECATED
function nkf_base_version_2_allowed_pages($path) {
  $patterns = theme_get_setting('nkf_base_version_2_paths');
  if (drupal_match_path($path, $patterns)) {
    return TRUE;
  }
}
*/
