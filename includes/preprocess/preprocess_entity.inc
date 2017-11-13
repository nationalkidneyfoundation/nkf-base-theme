<?php


/**
 * Implements hook_preprocess_entity
 */
function nkf_base_preprocess_entity(&$vars) {
  // Add generic preprocessing so we can create functions
  // like nkf_base_preprocess_entity_<type>_<bundle>.
  if (isset($vars['entity_type']) && isset($vars[$vars['entity_type']]->type)) {
    $function = __FUNCTION__ . '_' . $vars['entity_type'] . '_' . $vars[$vars['entity_type']]->type;
    print $function .'<br>';
    if (function_exists($function)) {
      $function($vars);
    }
  }

  // TODO: move this to a separate preprocess file entity_bean_banner.
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

function nkf_base_preprocess_node_new_event(&$vars) {
  print 'we got a new event node';
}
