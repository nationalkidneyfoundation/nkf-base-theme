<?php

function nkf_base_preprocess_views_view(&$vars) {
  $view = $vars['view'];
  if($view->name == 'site_search') {
    
    $vars['classes_array'][] = 'searching';
    if (module_exists('facetapi')) {
      $facets = facetapi_get_block_info(array('block'));
      foreach($facets as $key => $value) {
        if(substr($value['info'], -11) == 'Filed Under') {
          $id = $key;
          break;
        }
      }
    }
    $block = module_invoke('facetapi', 'block_view', $id);
    $vars['facets'] = render($block['content']);
  }
}
