<?php

/**
 * Implements hook_preprocess_panels_pane
 */
function nkf_base_preprocess_panels_pane(&$vars) {
  // Add class to panel panes.
  if (in_array($vars['display']->layout, array('flex', 'flex-center', 'widescreen'))){
    $vars['classes_array'][] = 'grid-cell';
  }
}
