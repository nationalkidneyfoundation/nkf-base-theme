<?php

/**
 * Override or insert variables into the block templates.
 *
 * Implements hook_preprocess_block
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
