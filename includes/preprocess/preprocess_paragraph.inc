<?php

/**
 * Helper function for paragraph prefixing
 */
function nkf_base_get_clean_title($title) {
  module_load_include('inc', 'pathauto', 'pathauto');
  return pathauto_cleanstring($title);
}

/**
 * Helper function for paragraph prefixing
 */
function nkf_base_get_label($paragraph) {
  $text_display = array(
    'label'=>'hidden',
    'type' => 'text_summary_or_trimmed',
    'settings'=>array('trim_length' => 100),
  );
  $image_display = array(
    'type' => 'image',
    'label'=>'hidden',
    'settings' => array(
      'image_style' => 'thumbnail',
    ),
  );
  if (isset($paragraph->field_paragraph_title) && !empty($paragraph->field_paragraph_title[LANGUAGE_NONE][0])) {
    $field = 'field_paragraph_title';
    $display = $text_display;
  } elseif (isset($paragraph->field_base_description) && !empty($paragraph->field_base_description[LANGUAGE_NONE][0])) {
    $field = 'field_base_description';
    $display = $text_display;
  } elseif (isset($paragraph->field_base_image) && !empty($paragraph->field_base_image[LANGUAGE_NONE][0])) {
    $field = 'field_base_image';
    $display = $image_display;
  }

  return strip_tags(render(field_view_field('paragraphs_item', $paragraph, $field, $display)), '<img>');
}

/*
 * Helper for paragraph publish/unpublish
 */
function nkf_base_paragraph_set_theme(&$vars, $template) {
  $published = nkf_base_paragraph_published($vars['paragraphs_item']);
  // Check to see if we are in edit mode, then set variables for display.
  if ($vars['view_mode'] == 'paragraphs_editor_preview') {
    if ($published) {
      $vars['status'] = '<span class="caps font-size--sm">published</span>';
    } else {
      $vars['status'] = '<span class="caps font-size--sm"><strong class="color--red">not</strong> published</span>';
    }
    $vars['label'] = nkf_base_get_label($vars['paragraphs_item']);
    $vars['theme_hook_suggestions'][] = 'paragraphs_editor_view';
  } else {
      // If published send to standard template.
      if ($published) {
        $vars['theme_hook_suggestions'][] = $template;
  // If not published and user has access show as unpublished.
  } elseif (user_access ('administer nodes')) {
        $vars['classes_array'][] = 'paragraph--unpublished';
        $vars['theme_hook_suggestions'][] = $template;
  // Otherwise, don't display.
  } else {
        $vars['theme_hook_suggestions'][] = 'empty';
      }
  }
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_list_accordion(&$vars) {
  // Add class to panel panes.
  $published = nkf_base_paragraph_published($vars['paragraphs_item']);
  $vars['classes_array'][] = 'list__accordion';
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['items'] = render($vars['content']['field_list_item_complex']);
  if($vars['title']) {
    $vars['title_anchor'] = nkf_base_get_clean_title($vars['title']);
  }
  $template = 'list_accordion';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_freeform(&$vars) {
  // Add class to panel panes.
  $published = nkf_base_paragraph_published($vars['paragraphs_item']);
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  if($vars['title']) {
    $vars['title_anchor'] = nkf_base_get_clean_title($vars['title']);
  }
  $template = 'freeform';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_list_content(&$vars) {

  $display = $vars['field_list_content_flavor'][0]['value'];
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $list_template = '';
  $item_template = '';
  switch ($display) {
    case 'grid':
      $item_template = 'card_pic';
      $list_template = 'list_content_grid';
      break;
    case 'list_tiles_small':
      $item_template = 'tile_landscape_small';
      $list_template = 'list_content_tiles_small';
      $vars['classes_array'][] = 'prose';
      $vars['classes_array'][] = 'center';
      break;
    case 'list_tiles_medium':
      $item_template = 'tile_landscape_medium';
      $list_template = 'list_content_tiles';
      $vars['classes_array'][] = 'prose';
      $vars['classes_array'][] = 'center';
      break;
    case 'list_tiles_large':
      $item_template = 'tile_landscape_large';
      $list_template = 'list_content_tiles';
      $vars['classes_array'][] = 'prose';
      $vars['classes_array'][] = 'center';
      break;
    case 'slider':
      $item_template = 'card_pic';
      $list_template = 'list_content_slider';
      break;
  }
  $vars['items'] = array();
  foreach ($vars['field_base_related_entity'] as $key => $value) {
    $meta = nkf_base_get_node_meta($value['entity']);
    $item['title'] = $value['entity']->title;
    $item['description'] = strip_tags(text_summary($meta['desc'], NULL, 200));
    $item['img_src'] = $meta['image']['uri'];
    $item['path'] = url('node/' . $value['entity']->nid);
    $vars['items'][] = theme($item_template, $item);
  }

  nkf_base_paragraph_set_theme($vars, $list_template);
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_promo_banner(&$vars) {
  $published = nkf_base_paragraph_published($vars['paragraphs_item']);
  $id = 'id-' . $vars['id'];
  $vars['attributes_array']['id'] = $id;
  $vars['bg_color'] = $vars['field_section_background_color'][0]['value'];
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['subtitle'] = render($vars['content']['field_paragraph_subtitle']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $vars['image'] = render($vars['content']['field_base_image']);
  $vars['ctas'] = $vars['field_base_cta'];
  foreach ($vars['ctas'] as $key => $value){
    if ($key == 0){
      $vars['ctas'][$key]['button'] = 'button--gray-4';
    } else {
      $vars['ctas'][$key]['button'] = 'button--outline--gray-4';
    }
  }

  if($vars['title']) {
    $vars['title_anchor'] = nkf_base_get_clean_title($vars['title']);
  }
  $template = 'promo_banner';
  nkf_base_paragraph_set_theme($vars, $template);
}

function nkf_base_preprocess_entity_paragraphs_item_hero(&$vars) {
  $published = nkf_base_paragraph_published($vars['paragraphs_item']);
  $id = 'id-' . $vars['id'];
  $vars['attributes_array']['id'] = $id;
  $vars['classes_array'][]= $vars['field_section_background_color'][0]['value'];
  $vars['classes_array'][] = $vars['field_hero_background_image'][0]['value'];
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['subtitle'] = render($vars['content']['field_paragraph_subtitle']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $vars['image'] = render($vars['content']['field_base_image']);
  $vars['ctas'] = $vars['field_base_cta'];
  foreach ($vars['ctas'] as $key => $value){
    if ($key == 0){
      $vars['ctas'][$key]['button'] = 'button--gray-4';
    } else {
      $vars['ctas'][$key]['button'] = 'button--outline--gray-4';
    }
  }

  if($vars['title']) {
    $vars['title_anchor'] = nkf_base_get_clean_title($vars['title']);
  }
  $template = 'nkf_hero';
  nkf_base_paragraph_set_theme($vars, $template);
}

/*
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_list_accordion_item(&$vars) {
  $published = nkf_base_paragraph_published($vars['paragraphs_item']);
  $vars['title'] = render($vars['content']['field_list_title']);
  $body = render($vars['content']['field_base_description']);
  $alter = array(
    'max_length' => 50, //Integer
    'ellipsis' => TRUE, //Boolean
    'word_boundary' => TRUE, //Boolean
    'html' => TRUE, //Boolean
  );
  $vars['description'] = $body;//views_trim_text($alter, $body);
  $vars['iid'] = 'list__accordion--' . $vars['id'];
  $template = 'list_accordion_item';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_text_summary(&$vars) {
  $published = nkf_base_paragraph_published($vars['paragraphs_item']);
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  if($vars['title']) {
    $vars['title_anchor'] = nkf_base_get_clean_title($vars['title']);
  }
  $template = 'text_summary';
  nkf_base_paragraph_set_theme($vars, $template);
}


/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_text_basic(&$vars) {

  $published = nkf_base_paragraph_published($vars['paragraphs_item']);
  $id = 'id-' . $vars['id'];
  $vars['attributes_array']['id'] = $id;

  $vars['title'] = render($vars['content']['field_paragraph_title']);
  if($vars['title']) {
    module_load_include('inc', 'pathauto', 'pathauto');
    $title_anchor = pathauto_cleanstring($vars['title']);
    $vars['title_anchor'] = $title_anchor;
  }
  $vars['body'] = render($vars['content']['field_base_description']);
  $image = render($vars['content']['field_base_image']);
  $vars['caption'] = render($vars['content']['field_base_caption']);
  $pullquote = render($vars['content']['field_base_pull_quote']);
  $video = render($vars['content']['field_base_video']);
  $offset_orientation = $vars['field_base_offset_orientation'][0]['value'];
  if ($video) {
    $vars['offset_content'] = $video;
  } elseif ($image) {
    $vars['offset_content'] = $image;
  } elseif ($pullquote) {
    $vars['offset_content'] = $pullquote;
  }

  if ($vars['offset_content']) {
    if ($offset_orientation == 'left') {
      $vars['offset_left'] = TRUE;
    } else {
      $vars['offset_right'] = TRUE;
    }
  }
  $template = 'text_general';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_list_toc(&$vars) {
  $published = nkf_base_paragraph_published($vars['paragraphs_item']);
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

  $template = 'nkf_base_toc';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_big_media(&$vars) {
  $published = nkf_base_paragraph_published($vars['paragraphs_item']);
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['media'] = render($vars['content']['field_base_image']);
  $vars['caption'] = render($vars['content']['field_base_caption']);

  $template = 'big_media';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Implements hook_preprocess_<entity_type>_<bundle>
 */
function nkf_base_preprocess_entity_paragraphs_item_layout_50x50(&$vars) {
  $published = nkf_base_paragraph_published($vars['paragraphs_item']);
  $vars['left'] = render($vars['content']['field_paragraph_layout_left']);
  $vars['right'] = render($vars['content']['field_paragraph_layout_right']);
  $vars['bg_color'] = $vars['field_section_background_color'][0]['value'];
  $vars['caption'] = render($vars['content']['field_base_caption']);
  $template = 'layout_50_50';
  nkf_base_paragraph_set_theme($vars, $template);
}
