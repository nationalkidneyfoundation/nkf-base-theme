<?php
/*function nkf_base_preprocess_list_content_grid(&$vars) {

}*/
function nkf_base_preprocess(&$vars, $hook) {
  //dpm($vars, $hook);
}

function nkf_base_preprocess_list_accordion(&$vars, $hook) {
  if (!isset($vars['classes'])) {
    $vars['classes'] = array();
  }
  $vars['classes'] = is_array($vars['classes']) ? implode(' ', $vars['classes']) : $vars['classes'];
}

function nkf_base_preprocess_list_accordion_item(&$vars) {
  static $id = 0;
  if (!isset($vars['iid'])) {
    $vars['iid'] = 'i-' . $id;
  }
  $id++;
}

function nkf_base_preprocess_card_badge(&$vars, $hook) {
  if (!isset($vars['classes'])) {
    $vars['classes'] = array();
  }
  $vars['classes'] = is_array($vars['classes']) ? implode(' ', $vars['classes']) : $vars['classes'];
}
