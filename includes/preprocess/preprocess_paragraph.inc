<?php

/**
 * Implements hook_preprocess_paragraph
 */
//function nkf_base_preprocess_paragraphs_items(&$vars) {

//}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_list_accordion(&$vars) {
  // Add class to panel panes.
  $vars['classes_array'][] = 'list__accordion';
  $vars['classes_array'][] = 'bg--gray-1';
  $vars['classes_array'][] = 'padding--lg ';
  //$vars['items'] = $vars['content']['field_list_item_complex'];
  //$vars['theme_hook_suggestions'][] = 'list_accordion';
}
/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_list_accordion_item(&$vars) {
  $vars['title'] = render($vars['content']['field_list_title']);
  $vars['description'] = render($vars['content']['field_base_description']);
  $vars['iid'] = 'list__accordion--' . $vars['id'];
  $vars['theme_hook_suggestions'][] = 'list_accordion_item';
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_summary_text(&$vars) {
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $vars['theme_hook_suggestions'][] = 'text_summary';
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_text_basic(&$vars) {
  //dpm($vars);
  $id = 'id-' . $vars['id'];
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $vars['left_media'] = render($vars['content']['field_base_image']);
  $vars['right_pullquote'] = render($vars['content']['field_base_pull_quote']);

  $vars['attributes_array']['id'] = $id;
  $vars['classes_array'][] = 'prose';
  $vars['classes_array'][] = 'padding-x--xxxl';
  if ($vars['view_mode'] === 'paragraphs_editor_preview') {
    //$vars['theme_hook_suggestions'][] = 'text_general_preview';
    $vars['classes_array'][] = 'height--md';
    $vars['classes_array'][] = 'margin-y--xl';
    $vars['classes_array'][] = 'border';
    $vars['classes_array'][] = 'border-width--md';
    $vars['classes_array'][] = 'border-color--gray-4';
    $vars['classes_array'][] = 'overflow-y--scroll';
    $vars['admin_footer'] = '<div class="position--absolute bottom margin-bottom--xl- z-index--100">
      <a class="bg--gray-4 display--inline-block color--white padding-x--sm padding-bottom--sm"
         href="#"
         data-toggle="class" data-target="#'.$id.'|.blah i" data-class="height--md|hide">
        <i class="icon-down-open "></i>
        <i class="icon-up-open hide"></i>
      </a>
    </div>';
  } else {
    $vars['classes_array'][] = 'center';
  }
  $vars['theme_hook_suggestions'][] = 'text_general';
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_list_toc(&$vars) {
  // Get host node.
  $node = $vars['paragraphs_item']->hostEntity();
  // Loop through other paragraphs.
  $paragraphs = $node->field_paragraph_section[LANGUAGE_NONE];
  foreach ($paragraphs as $paragraph) {
    $p_ids[] = $paragraph['value'];
  }
  $paragraphs = entity_load('paragraphs_item', $p_ids);
  foreach ($paragraphs as $paragraph) {
    if (isset($paragraph->field_paragraph_title) && isset($paragraph->field_paragraph_title[LANGUAGE_NONE])) {
      $titles[] = render(field_view_field('paragraphs_item', $paragraph, 'field_paragraph_title',array('label' => 'hidden')));
    }
  }
  $vars['items'] = $titles;
  $vars['theme_hook_suggestions'][] = 'nkf_base_toc';
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_big_media(&$vars) {
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['media'] = render($vars['content']['field_base_image']);
  $vars['theme_hook_suggestions'][] = 'big_media';
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_layout_50x50(&$vars) {
  //dpm($vars);
  $vars['left'] = render($vars['content']['field_paragraph_layout_left']);
  $vars['right'] = render($vars['content']['field_paragraph_layout_right']);
  $vars['bg_color'] = render($vars['field_section_background_color'][0]['value']);
  $vars['theme_hook_suggestions'][] = 'layout_50_50';
}
