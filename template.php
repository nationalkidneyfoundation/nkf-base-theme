<?php

// Define theme directory path
define('NKF_BASE_PATH', drupal_get_path('theme', 'nkf_base'));



// Theme includes
require_once NKF_BASE_PATH . '/includes/preprocess.inc';
require_once NKF_BASE_PATH . '/includes/helpers.inc';
require_once NKF_BASE_PATH . '/includes/form.inc';
require_once NKF_BASE_PATH . '/includes/styleguide.inc';

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
    'card_pic' => array(
      'template' => 'card-pic-v2',
      'path' => NKF_BASE_PATH . '/templates/cards',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
      ),
    ),
    'card_badge' => array(
      'template' => 'card-badge',
      'path' => NKF_BASE_PATH . '/templates/cards',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
      ),
    ),
    'tile_landscape_small' => array(
      'template' => 'tile-landscape-small',
      'path' => NKF_BASE_PATH . '/templates/tiles',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'title_prefix' => NULL,
        'img_src' => NULL,
        'path' => NULL
      ),
    ),
    'tile_landscape_medium' => array(
      'template' => 'tile-landscape-medium',
      'path' => NKF_BASE_PATH . '/templates/tiles',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'title_prefix' => NULL,
        'img_src' => NULL,
        'path' => NULL,
        'body' => NULL,
      ),
    ),
    'tile_landscape_large' => array(
      'template' => 'tile-landscape-large',
      'path' => NKF_BASE_PATH . '/templates/tiles',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'title_prefix' => NULL,
        'img_src' => NULL,
        'path' => NULL,
        'body' => NULL,
      ),
    ),
    'tile_portrait_large' => array(
      'template' => 'tile-portrait-large',
      'path' => NKF_BASE_PATH . '/templates/tiles',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'title_prefix' => NULL,
        'img_src' => NULL,
        'path' => NULL,
        'body' => NULL,
      ),
    ),
    'tile_portrait_medium' => array(
      'template' => 'tile-portrait-medium',
      'path' => NKF_BASE_PATH . '/templates/tiles',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'title_prefix' => NULL,
        'img_src' => NULL,
        'path' => NULL,
        'body' => NULL,
      ),
    ),
    'footer' => array(
      'template' => 'footer',
      'path' => NKF_BASE_PATH . '/templates/misc',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
      ),
    ),
    'list_content_grid' => array(
      'template' => 'list-content-grid',
      'path' => NKF_BASE_PATH . '/templates/lists',
      'type' => 'theme',
      'preprocess functions' => array('nkf_base_preprocess_list_content_grid'),
      'variables' => array(
        'items' => NULL,
      ),
    ),
    'list_content_highlight_grid' => array(
      'template' => 'list-content-highlight-grid',
      'path' => NKF_BASE_PATH . '/templates/lists',
      'type' => 'theme',
      'preprocess functions' => array('nkf_base_preprocess_list_content_grid'),
      'variables' => array(
        'items' => NULL,
      ),
    ),
    'list_compact' => array(
      'template' => 'list-compact',
      'path' => NKF_BASE_PATH . '/templates/lists',
      'type' => 'theme',
      'variables' => array(
        'items' => NULL,
      ),
    ),
    'list_content_tiles' => array(
      'template' => 'list-content-tiles',
      'path' => NKF_BASE_PATH . '/templates/lists',
      'type' => 'theme',
      'variables' => array(
        'items' => NULL,
      ),
    ),
    'list_content_slider' => array(
      'template' => 'list-content-slider',
      'path' => NKF_BASE_PATH . '/templates/lists',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'body' => NULL,
        'image' => NULL,
        'more' => NULL,
      ),
    ),
    'list_tabbed_slider' => array(
      'template' => 'list-tabbed-slider',
      'path' => NKF_BASE_PATH . '/templates/lists',
      'type' => 'theme',
      'variables' => array(
        'items' => NULL,
      ),
    ),
    'tabbed_slider_item' => array(
      'template' => 'tabbed-slider-item',
      'path' => NKF_BASE_PATH . '/templates/lists',
      'type' => 'theme',
      'variables' => array(
        ''
      ),
    ),
    'nkf_base_search_result_item' => array(
      'template' => 'search-result-item',
      'path' => NKF_BASE_PATH . '/templates/search',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'body' => NULL,
        'img_src' => NULL,
        'toc' => NULL,
        'path' => NULL,
        'filed_in' => NULL,
      ),
    ),
    'promo_banner' => array(
      'template' => 'banner-promo',
      'path' => NKF_BASE_PATH . '/templates/media',
      'type' => 'theme',
      'variables' => array(
        'header' => NULL,
        'image' => NULL,
        'body' => NULL,
        'ctas' => NULL,
        'bg_color' => NULL,
        'publish' => NULL,
        'unpublish' => NULL,
      ),
    ),
    'promo_inline_banner' => array(
      'template' => 'promo-inline-banner',
      'path' => NKF_BASE_PATH . '/templates/media',
      'type' => 'theme',
      'variables' => array(
        'header' => NULL,
        'image' => NULL,
        'body' => NULL,
        'ctas' => NULL,
        'bg_color' => NULL,
        'publish' => NULL,
        'unpublish' => NULL,
      ),
    ),
    'nkf_hero' => array(
      'template' => 'nkf-hero',
      'path' => NKF_BASE_PATH . '/templates/media',
      'type' => 'theme',
      'variables' => array(
        'header' => NULL,
        'body' => NULL,
        'ctas' => NULL,
        'publish' => NULL,
        'unpublish' => NULL,
      ),
    ),
    'kidney_bean_hero' => array(
      'template' => 'kidney-bean-hero',
      'path' => NKF_BASE_PATH . '/templates/media',
      'type' => 'theme',
      'variables' => array(
        'header' => NULL,
        'body' => NULL,
        'ctas' => NULL,
        'publish' => NULL,
        'unpublish' => NULL,
      ),
    ),
    'list_accordion' => array(
      'template' => 'list-accordion',
      'path' => NKF_BASE_PATH . '/templates/lists',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'items' => NULL,
      ),
    ),
    'list_accordion_item' => array(
      'template' => 'list-accordion-item',
      'path' => NKF_BASE_PATH . '/templates/lists',
      'type' => 'theme',
      'preprocess functions' => array('nkf_base_preprocess_list_accordion_item'),
      'override preprocess functions' => TRUE,
      'variables' => array(
        'title' => NULL,
        'description' => NULL,
        'iid' => NULL,
      ),
    ),
    'list_accordion_preview_item' => array(
      'template' => 'list-accordion-item',
      'path' => NKF_BASE_PATH . '/templates/lists',
      'type' => 'theme',
      'preprocess functions' => array('nkf_base_preprocess_list_accordion_preview_item'),
      'override preprocess functions' => TRUE,
      'variables' => array(
        'title' => NULL,
        'description' => NULL,
        'iid' => NULL,
      ),
    ),
    'grid_cell' => array(
      //'template' => 'list-accordion-item',
      //'path' => NKF_BASE_PATH . '/templates/lists',
      //'type' => 'theme',
      'variables' => array(
        'content' => NULL,
        'attributes' => NULL
      ),
    ),

    'component_wrapper' => array(
      'render element'  => 'element'
    ),

    // Text templates.
    'text_general' => array(
      'template' => 'text-general',
      'path' => NKF_BASE_PATH . '/templates/text',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'body' => NULL,
        'left_media' => NULL,
        'right_media' => NULL,
        'left_pullquote' => NULL,
        'right_pullquote' => NULL,
        'caption' => NULL,
        'more' => NULL,
      ),
    ),
    'text_general_preview' => array(
      'template' => 'text-general-preview',
      'path' => NKF_BASE_PATH . '/templates/text',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'body' => NULL,
        'left_media' => NULL,
        'right_media' => NULL,
        'left_pullquote' => NULL,
        'right_pullquote' => NULL,
        'caption' => NULL,
      ),
    ),
    'text_summary' => array(
      'template' => 'text-summary',
      'path' => NKF_BASE_PATH . '/templates/text',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'body' => NULL,
      ),
    ),
    'text_testimonial' => array(
      'template' => 'text-testimonial-v2',
      'path' => NKF_BASE_PATH . '/templates/text',
      'type' => 'theme',
      'variables' => array(
        'image' => NULL,
        'body' => NULL,
        'name' => NULL,
        'city' => NULL,
      ),
    ),
    'basic_contact' => array(
      'template' => 'basic-contact',
      'path' => NKF_BASE_PATH . '/templates/misc',
      'type' => 'theme',
      'variables' => array(
        'name' => NULL,
        'form' => NULL,
        'body' => NULL,
        'bg_color' => NULL,
        'tagline' => NULL,
      ),
    ),
    'contact_special' => array(
      'template' => 'special-contact',
      'path' => NKF_BASE_PATH . '/templates/misc',
      'type' => 'theme',
      'variables' => array(
        'name' => NULL,
        'nkfrole'=> NULL,
        'image' => NULL,
        'form' => NULL,
        'body' => NULL,
        'bg_color' => NULL,
        'tagline' => NULL,
      ),
    ),
    'text_email_capture' => array(
      'template' => 'text-email-capture',
      'path' => NKF_BASE_PATH . '/templates/text',
      'type' => 'theme',
      'variables' => array(
        'header' => NULL,
        'body' => NULL,
        'ctas' => NULL,
        'bg_color' => NULL,
        'publish' => NULL,
        'unpublish' => NULL,
      ),
    ),
    'filtered_search' => array(
      'template' => 'filtered-search',
      'path' => NKF_BASE_PATH . '/templates/search',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'description' => NULL,
        'form' => NULL
      ),
    ),
    'big_media' => array(
      'template' => 'big-media',
      'path' => NKF_BASE_PATH . '/templates/media',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'body' => NULL,
        'caption' => NULL,
        'image' => NULL,
        'video' => NULL,
      ),
    ),
    'layout_flex' => array(
      'template' => 'layout-flex',
      'path' => NKF_BASE_PATH . '/templates/layouts',
      'type' => 'theme',
      'variables' => array(
        'header' => NULL,
        'subheader' => NULL,
        'bg_color' => NULL,
      ),
    ),
    'layout_30_30_30' => array(
      'template' => 'layout-30-30-30',
      'path' => NKF_BASE_PATH . '/templates/layouts',
      'type' => 'theme',
      'variables' => array(
        'left' => NULL,
        'center'=> NULL,
        'right' => NULL,
        'bg_color' => NULL,
      ),
    ),
    'layout_50_50' => array(
      'template' => 'layout-50-50',
      'path' => NKF_BASE_PATH . '/templates/layouts',
      'type' => 'theme',
      'variables' => array(
        'left' => NULL,
        'right' => NULL,
        'bg_color' => NULL,
      ),
    ),
    'nkf_base_toc' => array(
      'template' => 'list-toc',
      'path' => NKF_BASE_PATH . '/templates/lists',
      'type' => 'theme',
      'variables' => array(
        'items' => NULL
      ),
    ),
    'freeform' => array(
      'template' => 'freeform',
      'path' => NKF_BASE_PATH . '/templates/misc',
      'type' => 'theme',
      'variables' => array(
        'items' => NULL
      ),
    ),
    'paragraphs_editor_view' => array(
      'template' => 'paragraphs-editor-view',
      'path' => NKF_BASE_PATH . '/templates/misc',
      'type' => 'theme',
      'variables' => array(
        'label' => NULL,
        'status' => NULL
      ),
    ),
    'paragraphs_editor_view_wrapper' => array(
      'template' => 'paragraphs-editor-view-wrapper',
      'path' => NKF_BASE_PATH . '/templates/misc',
      'type' => 'theme',
      'render element'  => 'element'
    ),
    'nkf_base_section_header' => array(
      'template' => 'section-header',
      'path' => NKF_BASE_PATH . '/templates/partials',
      'type' => 'theme',
      'variables' => array(
        'header' => NULL
      ),
    ),
    'nkf_base_section_sm_header' => array(
      'template' => 'section-sm-header',
      'path' => NKF_BASE_PATH . '/templates/partials',
      'type' => 'theme',
      'variables' => array(
        'smheader' => NULL
      ),
    ),
    'nkf_base_section_subheader' => array(
      'template' => 'section-subheader',
      'path' => NKF_BASE_PATH . '/templates/partials',
      'type' => 'theme',
      'variables' => array(
        'subheader' => NULL
      ),
    ),
    'nkf_base_section_body' => array(
      'template' => 'section-body',
      'path' => NKF_BASE_PATH . '/templates/partials',
      'type' => 'theme',
      'variables' => array(
        'body' => NULL
      ),
    ),
    'nkf_base_section_video_embed' => array(
      'template' => 'section-video-embed',
      'path' => NKF_BASE_PATH . '/templates/partials',
      'type' => 'theme',
      'variables' => array(
        'video' => NULL
      ),
    ),
    'nkf_base_section_caption' => array(
      'template' => 'section-caption',
      'path' => NKF_BASE_PATH . '/templates/partials',
      'type' => 'theme',
      'variables' => array(
        'caption' => NULL
      ),
    ),
    'logo_section' => array(
      'template' => 'logo-section',
      'path' => NKF_BASE_PATH . '/templates/media',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'header' => NULL,
        'subheader' => NULL,
        'more' => NULL
      ),
    ),
    'logo_item' => array(
      'template' => 'logo-item',
      'path' => NKF_BASE_PATH . '/templates/media',
      'type' => 'theme',
      'variables' => array(
        'logo' => NULL,
        'text-logo' => NULL
      ),
    ),
    'card' => array(
      'template' => 'card',
      'path' => NKF_BASE_PATH . '/templates/cards',
      'type' => 'theme',
      'variables' => array(
        'overlay_header' => NULL,
        'overlay_subheader' => NULL,
        'image' => NULL,
        'video' => NULL,
        'headline' => NULL,
        'body' => NULL,
        'more' => NULL,
      ),
    ),
    'opportunity_item' => array(
      'template' => 'opportunity-item',
      'path' => NKF_BASE_PATH . '/templates/cards',
      'type' => 'theme',
      'variables' => array(
        'image' => NULL,
        'op_type' => NULL,
        'headline' => NULL,
        'location' => NULL,
        'body' => NULL,
        'more' => NULL,
      ),
    ),
    'opportunity_section' => array(
      'template' => 'opportunity-section',
      'path' => NKF_BASE_PATH . '/templates/cards',
      'type' => 'theme',
      'variables' => array(
        'title' => NULL,
        'header' => NULL,
        'subheader' => NULL,
        'more' => NULL
      ),
    ),
    'empty' => array(
      'variables' => array(
        'items' => NULL
      ),
    ),
  );
}
function nkf_base_empty($vars) {
  return '<div></div>';
}

function nkf_base_paragraphs_field_widget_form_alter(&$element, &$form_state, $context) {
  if (!isset($element['#after_build'])) {
    $element['#theme'] = 'paragraphs_editor_view_wrapper';
  }
}
/**
 * Implements hook_form_FORM_ID_alter()
 */
function nkf_base_form_redhen_donation_form_alter(&$form, &$form_state, $form_id) {
  drupal_add_js(NKF_BASE_PATH . '/js/donate-form.js');
}

/**
 * Implements hook_entity_info_alter().
 */
function nkf_base_entity_info_alter(&$entity_info) {
  $entity_info['node']['view modes']['search_result_item'] = array(
    'label' => t('Search result item'),
    'custom settings' => TRUE,
  );
}

function nkf_base_item_list($vars) {
  //dpm(debug_backtrace()[2]['function']);
  //print 'test';
  //return theme('item_list', $vars);
  return theme_item_list($vars);
}

/**
 * Default theme for the wrapper around a user's achievements page.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: A render containing the user's achievements page.
 */
function theme_component_wrapper($variables) {
  return '<div class="WRAPPER TEST">' . $variables['element']['#children'] . '</div>';
}

function nkf_base_grid_cell($vars) {
  $content = $vars['content'];
  $attributes = $vars['attributes'];
  //print 'atr';
  $attributes['class'][] = 'grid-cell';
  //print 'attr';
  return '<div ' . drupal_attributes($attributes) . '>'.$content.'</div>';
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
    'profiles/kidneys_distro/modules/contrib/date/date_popup/themes/datepicker.1.7.css' => FALSE,
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


/* DEPRECATED
function nkf_base_version_2_allowed_pages($path) {
  $patterns = theme_get_setting('nkf_base_version_2_paths');
  if (drupal_match_path($path, $patterns)) {
    return TRUE;
  }
}
*/
