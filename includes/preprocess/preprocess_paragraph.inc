<?php

function nkf_base_preprocess_paragraphs_editor_view_wrapper(&$vars) {

  $element = $vars['element'];
  $paragraph = $element['#entity'];
  $vars['id'] = 'id-' . $paragraph->item_id;
  $vars['attributes']['id'] = $vars['id'];
  //$vars['classes_array'][] = $vars['id'];
  $vars['title'] = render($element['paragraph_bundle_title']);
  $vars['actions'] = render($element['actions']);
  $vars['preview'] = render($element['paragraph_bundle_preview']);
  $vars['label'] = nkf_base_get_label($paragraph);
  $vars['status'] = nkf_base_paragraph_status($paragraph);

  // Not sure why we need to do this here.
  $vars['classes'] = implode(' ', $vars['classes_array']);
  $vars['attributes'] = drupal_attributes($vars['attributes']);
}

/**
 * Helper function for paragraph prefixing
 */
function nkf_base_get_clean_title($title) {
  module_load_include('inc', 'pathauto', 'pathauto');
  return pathauto_cleanstring($title);
}

/**
 * Helper function for paragraph outer classes.
 */
function nkf_base_set_css_wrapper(&$vars, $width = 'narrow') {
  // TODO: grab any administrative classes (e.g. background color/ border)
  // and set them here.
  // ? how do we set these on the wrapper section?
  //dpm($vars);

  // Is this paragraph inside another paragraphs? Like a "Layout"...
  $entity = $vars['elements']['#entity'];
  $field_name = $entity->field_name;
  if ($field_name !== 'field_paragraph_section') {
    $width = 'narrow';
    $vars['classes_array'][] = 'layouted';
  }
  if ($width == 'narrow') {
    $vars['classes_array'][] = 'prose';
    $vars['classes_array'][] = 'center';
    $vars['classes_array'][] = 'padding-x--md';
    $vars['classes_array'][] = 'padding-y--xl';
  } elseif ($width == 'wide') {
    $vars['classes_array'][] = 'container';
    $vars['classes_array'][] = 'padding-y--xxxl';
    $vars['classes_array'][] = 'padding-x--md';
  } else if ($width == 'layout'){
    $vars['classes_array'][] = 'container';
    $vars['classes_array'][] = 'padding-y--md md--padding-y--xxxl';
  }
  $vars['wrapper_classes'] = array();
    if(!empty($vars['field_base_css'])) {
      $vars['wrapper_classes'][] = $vars['field_base_css'][0]['value'];
   }
    if(!empty($vars['field_section_background_color'])) {
      $bg_color = $vars['field_section_background_color'][0]['value'];
      $vars['wrapper_classes'][] = $bg_color;
      if(in_array($bg_color, array('bg--gray-4', 'bg--orange', 'bg--blue', 'bg--sky'))) {
        $vars['wrapper_classes'][] = ' color--white';
      }
    }
  $vars['wrapper_classes'] = implode(' ', $vars['wrapper_classes']);
}

/**
 * Helper function for paragraph prefixing
 */
function nkf_base_get_label($paragraph) {
  //dpm($paragraph, 'label');

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
  if (isset($paragraph->field_paragraph_admin_title) && !empty($paragraph->field_paragraph_admin_title[LANGUAGE_NONE][0])) {
    $field = 'field_paragraph_admin_title';
    $display = $text_display;
  } elseif (true) {
    return 'label';
  } elseif (isset($paragraph->field_paragraph_title) && !empty($paragraph->field_paragraph_title[LANGUAGE_NONE][0])) {
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
    $vars['preview'] = theme($template, $vars);
    $vars['theme_hook_suggestions'][] = 'paragraphs_editor_view';

    //$vars['theme_hook_suggestions'][] = $template;
  } else {
    // If published send to standard template.
    if ($published) {
      //$vars['theme_hook_suggestions'][] = $template;
      $vars['content'] = theme($template, $vars);
      //dpm($vars);
    } elseif (user_access ('administer nodes')) {
      $vars['classes_array'][] = 'paragraph--unpublished';
      //$vars['theme_hook_suggestions'][] = $template;
      $vars['theme_hook_suggestions'][] = 'empty';
    } else {
      $vars['theme_hook_suggestions'][] = 'empty';
    }
  }
}

/**
 * Accordion
 */
function nkf_base_preprocess_entity_paragraphs_item_list_accordion(&$vars) {
  // Add class to panel panes.
  $vars['classes_array'][] = 'list__accordion';
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  foreach(element_children($vars['content']['field_list_item_complex']) as $item) {
    $vars['items'][] = render($vars['content']['field_list_item_complex'][$item]);
  }
  if($vars['title']) {
    $vars['title_anchor'] = nkf_base_get_clean_title($vars['title']);
  }
  nkf_base_set_css_wrapper($vars, 'narrow');
  $template = 'list_accordion';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Freeform
 */
function nkf_base_preprocess_entity_paragraphs_item_freeform(&$vars) {
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  nkf_base_set_css_wrapper($vars, 'blank');
  $template = 'freeform';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Tabbed Slider
 */
function nkf_base_preprocess_entity_paragraphs_item_tabbed_slider(&$vars) {
  // Add slider js library.
  drupal_add_library('nkf_base', 'slick');
  $id = 'id-' . $vars['id'];
  $vars['attributes_array']['id'] = $id;
  $vars['id'] = $id;
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  foreach(element_children($vars['content']['field_paragraph_section']) as $key) {
    $vars['slider_items'][] = render($vars['content']['field_paragraph_section'][$key]);
  }
  foreach(element_children($vars['content']['field_paragraph_tab']) as $key) {
    $vars['nav_items'][] = render($vars['content']['field_paragraph_tab'][$key]);
  }
  nkf_base_set_css_wrapper($vars, 'wide');
  $template = 'list_tabbed_slider';
  nkf_base_paragraph_set_theme($vars, $template);
}

/** Slider Item */
function nkf_base_preprocess_entity_paragraphs_item_tabbed_slider_item(&$vars) {
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $vars['image'] = $vars['field_base_image'];
  $vars['more'] = render($vars['content']['field_base_link']);

  nkf_base_set_css_wrapper($vars, 'wide');
  $template = 'tabbed_slider_item';
  nkf_base_paragraph_set_theme($vars, $template);
}


/**
 * Content lists
 */
function nkf_base_preprocess_entity_paragraphs_item_list_content(&$vars) {

  $display = $vars['field_list_content_flavor'][0]['value'];
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $vars['more'] = render($vars['content']['field_base_link']);
  $vars['image'] = isset($vars['field_paragraph_image']) ? $vars['field_paragraph_image'] : FALSE;
  $list_template = '';
  $item_template = '';

  $c = count($vars['field_base_related_entity']);
  switch ($display) {
    case 'grid':
      $item_template = 'tile_portrait_medium';
      $list_template = 'list_content_grid';
      // Set the grid columns.
      if($c % 3 == 0) {
        $vars['width'] = 'sm--width--33';
      } elseif ($c % 4 == 0) {
        $vars['width'] = 'md--width--25 sm--width--50';
      } elseif ($c % 5 == 0) {
        $vars['width'] = 'md--width--20 sm--width--50';
      } elseif ($c % 3 > $c % 4) {
        $vars['width'] = 'sm--width--33';
      } else {
        $vars['width'] = 'md--width--25 sm--width--50';
      }
      $vars['width'] .= ' width--100';
      nkf_base_set_css_wrapper($vars, 'wide');
      break;
    case 'highlight_grid':
      $item_template = 'tile_portrait_medium';
      $list_template = 'list_content_highlight_grid';
      $highlighted_item = array_shift($vars['field_base_related_entity']);
      nkf_base_set_node_vars($highlighted_item['entity'], $item);
      $vars['highlighted_item'] = theme('tile_portrait_large', $item);
      nkf_base_set_css_wrapper($vars, 'wide');
      break;
    case 'list_compact':
      $item_template = 'tile_landscape_small';
      $list_template = 'list_compact';
      nkf_base_set_css_wrapper($vars, 'narrow');
      break;
    case 'list_tiles_medium':
      $item_template = 'tile_landscape_medium';
      $list_template = 'list_content_tiles';
      nkf_base_set_css_wrapper($vars, 'narrow');
      break;
    case 'list_tiles_large':
      $item_template = 'tile_landscape_large';
      $list_template = 'list_content_tiles';
      nkf_base_set_css_wrapper($vars, 'narrow');
      break;
    case 'slider':
      drupal_add_library('nkf_base', 'slick');
      $item_template = 'card_pic';
      $list_template = 'list_content_slider';
      nkf_base_set_css_wrapper($vars, 'wide');
      break;
  }
  $vars['items'] = array();
  foreach ($vars['field_base_related_entity'] as $key => $value) {
    $item = array();
    nkf_base_set_node_vars($value['entity'], $item);
    $vars['items'][] = theme($item_template, $item);
  }

  nkf_base_paragraph_set_theme($vars, $list_template);
}

/**
 * Promo Banner 
 * TODO: set margin/padding for text section based on wrapper classes.
 *
 */
function nkf_base_preprocess_entity_paragraphs_item_promo_banner(&$vars) {
  $id = 'id-' . $vars['id'];
  $vars['attributes_array']['id'] = $id;

  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['subtitle'] = render($vars['content']['field_paragraph_subtitle']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $vars['video'] = render($vars['content']['field_paragraph_video']);
  $vars['image'] = $vars['field_base_image'];
  if (isset($vars['field_base_cta'])) {
    $vars['ctas'] = $vars['field_base_cta'];
    foreach ($vars['ctas'] as $key => $value){
      if ($key == 0){
        $vars['ctas'][$key]['button'] = 'button--gray-4';
      } else {
        $vars['ctas'][$key]['button'] = 'button--outline--gray-4';
      }
    }

  }

  $template = 'promo_banner';
  nkf_base_set_css_wrapper($vars, 'full');
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Inline Promo Banner
 */
function nkf_base_preprocess_entity_paragraphs_item_promo_inline_banner(&$vars) {
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars ['inner_color'] = render($vars['field_inner_color'][0]['value']);
  $vars['subtitle'] = render($vars['content']['field_paragraph_subtitle']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $vars['video'] = render($vars['content']['field_paragraph_video']);
  $vars['image'] = $vars['field_base_image'];
  if (isset($vars['field_base_cta'])) {
    $vars['ctas'] = $vars['field_base_cta'];
    foreach ($vars['ctas'] as $key => $value){
      if ($key == 0){
        $vars['ctas'][$key]['button'] = 'button--outline--gray-4';
      } else {
        $vars['ctas'][$key]['button'] = 'button--gray-4';
      }
    }
  }
  nkf_base_set_css_wrapper($vars, 'wide');
  $template = 'promo_inline_banner';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Email capture 
 */
function nkf_base_preprocess_entity_paragraphs_item_email_capture(&$vars) {

  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['description'] = render($vars['content']['field_base_description']);
  $vars['form'] = render(kidney_misc_get_pardot_form());
  nkf_base_set_css_wrapper($vars, 'wide');
  $template = 'text_email_capture';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Heros
 */

function nkf_base_preprocess_entity_paragraphs_item_hero(&$vars) {
  $id = 'id-' . $vars['id'];
  $vars['hero_class'] = $vars['field_hero_background_image'][0]['value'];
  $image = $vars['field_hero_background_image'][0]['value'];
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $vars['bg_color'] = $vars['field_section_background_color'][0]['value'];
  $vars['ctas'] = $vars['field_base_cta'];
  $vars['text_color'] = '';
  $hero_template = '';
  foreach ($vars['ctas'] as $key => $value){
    if ($key == 0){
      $vars['ctas'][$key]['button'] = 'button--outline--gray-4';
    } else {
      $vars['ctas'][$key]['button'] = 'button--outline--white';
    }
  }
  
  //Switch templates based on which hero the user wants to use
  if ($image == 'kidney--bean') {
      $hero_template = 'kidney_bean_hero';
      foreach ($vars['field_hero_image'] as $key => $value){
        $hero_images[] = file_create_url(nkf_base_style_image_url($value, 'resize', 600, 350));
        if (!empty($hero_images)) {
          // Get the first image to show on load.
          $vars['hero_image'] = $hero_images[0];
        }
      }
  } else {
    $hero_template = 'nkf_hero';
    $hero_images = array();
    foreach ($vars['field_hero_image'] as $key => $value){
      $hero_images[] = file_create_url(nkf_base_style_image_url($value, 'resize', 2000, 600));
      if (!empty($hero_images)) {
        // Get the first image to show on load.
        $vars['hero_image'] = $hero_images[0];
        // Move the first image to the end of the line for rotation.
        $hero_images[] = array_shift($hero_images);
        $vars['hero_images'] = count($hero_images) > 1 ? implode(',', $hero_images) : '';
        $vars['text_color'] = 'color--white text-shadow';
      }
    }
  }

  nkf_base_set_css_wrapper($vars, 'nothing');
  nkf_base_paragraph_set_theme($vars, $hero_template);
}

/*
 * Accordion Items
 */
function nkf_base_preprocess_entity_paragraphs_item_list_accordion_item(&$vars) {
  $vars['title'] = render($vars['content']['field_list_title']);
  $body = render($vars['content']['field_base_description']);
  $vars['description'] = $body;//views_trim_text($alter, $body);
  $vars['iid'] = 'list__accordion--' . $vars['id'];
  nkf_base_set_css_wrapper($vars, 'nothing');
  $template = 'list_accordion_item';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Text Summary
 */
function nkf_base_preprocess_entity_paragraphs_item_text_summary(&$vars) {
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $template = 'text_summary';
  nkf_base_set_css_wrapper($vars, 'narrow');
  nkf_base_paragraph_set_theme($vars, $template);
}

function nkf_base_preprocess_entity_paragraphs_item_filtered_search_form(&$vars) {
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['description'] = render($vars['content']['field_base_description']);
  // TODO Make this a view filter not a static field.
  if (module_exists('kidneys_misc')) {
    $placeholder = strip_tags(render($vars['content']['field_search_placeholder_text']));
    $form = kidneys_misc_get_filtered_form($vars['field_ia_category'], $placeholder);
    $vars['form'] = $form;
  }
  $template = 'filtered_search';
  nkf_base_set_css_wrapper($vars, 'wide');
  nkf_base_paragraph_set_theme($vars, $template);
}

/*
* Text Testimonial
*/

function nkf_base_preprocess_entity_paragraphs_item_text_testimonial(&$vars) {
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $vars['image']= nkf_base_style_image($vars['field_base_image'], 'resize', 100, 100);
  $vars['name'] = render($vars['content']['field_base_caption']);
  $vars['city'] = render($vars['content']['field_base_city']);
  $template = 'text_testimonial';
  nkf_base_set_css_wrapper($vars, 'narrow');
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Text Basic 
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
  $vars['caption'] = render($vars['content']['field_base_caption']);
  $pullquote = render($vars['content']['field_base_pull_quote']);
  $vars['more'] = render($vars['content']['field_base_link']);
  $image = render($vars['content']['field_base_image']);
  $video = render($vars['content']['field_base_video']);
  $offset_orientation = 'left';
  if (isset($vars['field_base_offset_orientation'])) {
    $offset_orientation = $vars['field_base_offset_orientation'][0]['value'];
  }

  if ($video) {
    $vars['offset_content'] = $video;
  } elseif ($image) {
    $vars['offset_content'] = $image;
  } elseif ($pullquote) {
    $vars['offset_content'] = $pullquote;
  }

  $vars['offset_left'] = FALSE;
  $vars['offset_right'] = FALSE;
  if (isset($vars['offset_content'])) {
    if ($offset_orientation == 'left') {
      $vars['offset_left'] = TRUE;
    } else {
      $vars['offset_right'] = TRUE;
    }
  }
  nkf_base_set_css_wrapper($vars, 'narrow');
  $template = 'text_general';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Table of Contents
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
 * Big Media
 */
function nkf_base_preprocess_entity_paragraphs_item_big_media(&$vars) {
  $published = nkf_base_paragraph_published($vars['paragraphs_item']);
  $id = 'id-' . $vars['id'];
  $vars['attributes_array']['id'] = $id;

  $vars['title'] = render($vars['content']['field_paragraph_title']);
  if($vars['title']) {
    module_load_include('inc', 'pathauto', 'pathauto');
    $title_anchor = pathauto_cleanstring($vars['title']);
    $vars['title_anchor'] = $title_anchor;
  }
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['image'] = nkf_base_style_image($vars['field_base_image'], 'scale_crop', 800, 600);
  $vars['video'] = render($vars['content']['field_paragraph_video']);
  $vars['caption'] = render($vars['content']['field_base_caption']);
  nkf_base_set_css_wrapper($vars, 'narrow');
  $template = 'big_media';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Flex Layout
 */
function nkf_base_preprocess_entity_paragraphs_item_layout_flex(&$vars) {

  foreach (element_children($vars['content']['field_paragraph_section']) as $i) {
    $vars['sections'][] = render($vars['content']['field_paragraph_section'][$i]);
  }
  $i++;

  if (!empty($vars['field_paragraph_column_widths'][0]['value'])) {
    $width = $vars['field_paragraph_column_widths'][0]['value'];
    $column_css = array();
    $ws = explode('_', $width);
    $l = count($ws) - 1;
    foreach ($ws as $i => $value) {
      $column_css[] = 'sm--width--' . $value;
      // if ($i === 0) {
      //   $column_css[$i] .= ' sm--margin-right--md';
      // } else if($i === $l) {
      //     $column_css[$i] .= ' sm--margin--none';
      // } else {
      //     $column_css[$i] .= ' sm--margin-right--md';
      // }
      $column_css[$i] .= ' width--100';
    }
    $vars['column_css'] = $column_css;
    switch ($width) {
      case '50_50':
        $vars['width'] = 'sm--width--50';
        break;
      case '33_33_33':
        $vars['width'] = 'sm--width--33';
        break;
      case '33_66':
        $vars['width'] = 'sm--width--33';
        $vars['width_alt'] = 'sm--width--66';
        break;
      // TODO handle other layouts.
    }
  } else {
    if($i % 3 == 0) {
      $vars['width'] = 'sm--width--33';
    } elseif ($c % 4 == 0) {
      $vars['width'] = 'md--width--25 sm--width--50';
    } elseif ($c % 5 == 0) {
      $vars['width'] = 'md--width--33 sm--width--50';
    } elseif ($c % 3 > $c % 4) {
      $vars['width'] = 'sm--width--33';
    } else {
      $vars['width'] = 'sm--width--50';
    }
  }

  $vars['width'] .= ' width--100';
  $vars['header'] = render($vars['content']['field_paragraph_title']);
  $vars['subheader'] = render($vars['content']['field_base_description']);
  nkf_base_set_css_wrapper($vars, 'layout');
  $template = 'layout_flex';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Layout 50 x 50
 */
function nkf_base_preprocess_entity_paragraphs_item_layout_50x50(&$vars) {
  $vars['left'] = render($vars['content']['field_paragraph_layout_left']);
  $vars['right'] = render($vars['content']['field_paragraph_layout_right']);
  $vars['bg_color'] = $vars['field_section_background_color'][0]['value'];
  $vars['caption'] = render($vars['content']['field_base_caption']);
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  nkf_base_set_css_wrapper($vars, 'layout');
  $template = 'layout_50_50';
  nkf_base_paragraph_set_theme($vars, $template);
}

/**
 * Layout 30 x 30 x 30
 */
function nkf_base_preprocess_entity_paragraphs_item_layout_30x30x30(&$vars) {
  $vars['left'] = render($vars['content']['field_paragraph_layout_left']);
  $vars['center'] = render($vars['content']['field_paragraph_layout_center']);
  $vars['right'] = render($vars['content']['field_paragraph_layout_right']);
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $vars['bg_color'] = $vars['field_section_background_color'][0]['value'];
  nkf_base_set_css_wrapper($vars, 'layout');
  $template = 'layout_30_30_30';
  nkf_base_paragraph_set_theme($vars, $template);
}


/*
* Special Contact form
*/
function nkf_base_preprocess_entity_paragraphs_item_special_contact(&$vars) {
  $id = 'id-' . $vars['id'];
  $vars['attributes_array']['id'] = $id;
  $vars['bg_color'] = $vars['field_section_background_color'][0]['value'];
  if(in_array($vars['bg_color'], array('bg--gray-4', 'bg--orange', 'bg--blue'))) {
    $vars['bg_color'] .= ' color--white';
  }
  $vars['bg_color_only'] = $vars['field_section_background_color'][0]['value'];
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['image'] = nkf_base_style_image($vars['field_base_image'], 'resize', 300, 400, 'display--block');
  $vars['name'] = render($vars['content']['field_base_caption']);
  $vars['nkfrole'] = render($vars['content']['field_base_nkf_role']);
  $vars['phone'] = render($vars['content']['field_base_phone']);
  $vars['email'] = render($vars['content']['field_base_email']);
  $vars['title'] = render($vars['content']['field_paragraph_title']);
  $vars['body'] = render($vars['content']['field_base_description']);
  $vars['tagline'] = render($vars['content']['field_base_tag_line']);
  if (isset($vars['field_base_cta'])) {
    $vars['ctas'] = $vars['field_base_cta'];
    foreach ($vars['ctas'] as $key => $value){
      if ($key == 0){
        $vars['ctas'][$key]['button'] = 'button--gray-4';
      } else {
        $vars['ctas'][$key]['button'] = 'button--outline--gray-4';
      }
    }
  }
  //$pardot = $vars['field_pardot_form'][0]['value'];
  // Get rid of non-https path and replace with https.
  //$pardot = str_replace('http://www3.kidney.org/', '', $pardot);
  //$pardot = 'https://go.pardot.com/' . $pardot;
  //$vars['formDEP'] = nkf_base_make_iframe($pardot);

  $form_fields = array();
  if(!empty($vars['field_pardot_fields'])) {
    foreach ($vars['field_pardot_fields'] as $field) {
      $form_fields[] = $field['value'];
    }
  }
  $submit_text = trim(strip_tags(render($vars['content']['field_submit_button_text'])));
  $vars['form'] = render(kidney_misc_get_pardot_form($form_fields, $submit_text));
  nkf_base_set_css_wrapper($vars, 'nothing');
  $template = 'contact_special';
  nkf_base_paragraph_set_theme($vars, $template);
}

/*
* Basic Contact Form
*/
function nkf_base_preprocess_entity_paragraphs_item_basic_contact(&$vars) {
  $id = 'id-' . $vars['id'];
  $vars['attributes_array']['id'] = $id;
  $vars ['inner_color'] = render($vars['field_inner_color'][0]['value']);
  $vars['tagline'] = render($vars['content']['field_base_tag_line']);
  $vars['name'] = render($vars['content']['field_base_caption']);
  $vars['phone'] = render($vars['content']['field_base_phone']);
  $vars['email'] = render($vars['content']['field_base_email']);
  $vars['body'] = render($vars['content']['field_base_description']);
  if (isset($vars['field_base_cta'])) {
    $vars['ctas'] = $vars['field_base_cta'];
    foreach ($vars['ctas'] as $key => $value){
      if ($key == 0){
        $vars['ctas'][$key]['button'] = 'button--gray-4';
      } else {
        $vars['ctas'][$key]['button'] = 'button--outline--gray-4';
      }
    }
  }
  $form_fields = array();
  if(!empty($vars['field_pardot_fields'])) {
    foreach ($vars['field_pardot_fields'] as $field) {
      $form_fields[] = $field['value'];
    }
  }
  $submit_text = trim(strip_tags(render($vars['content']['field_submit_button_text'])));
  $vars['form'] = render(kidney_misc_get_pardot_form($form_fields, $submit_text));
  nkf_base_set_css_wrapper($vars, 'narrow');
  $template = 'basic_contact';
  nkf_base_paragraph_set_theme($vars, $template);
}


/*
* Logo Container
*/
function nkf_base_preprocess_entity_paragraphs_item_logo_section(&$vars) {
  foreach(element_children($vars['content']['field_logo_item_complex']) as $item) {
    $vars['items'][] = render($vars['content']['field_logo_item_complex'][$item]);
  }
  $vars['header'] = render($vars['content']['field_paragraph_title']);
  $vars['subheader'] = render($vars['content']['field_base_description']);
  $vars['more'] = render($vars['content']['field_base_link']);
  nkf_base_set_css_wrapper($vars, 'wide');
  $template = 'logo_section';
  nkf_base_paragraph_set_theme($vars, $template);
}

/*
* Logo items
*/

function nkf_base_preprocess_entity_paragraphs_item_logo_item(&$vars) {
  $vars ['logo'] = $vars['field_base_image'];
  $vars ['text_logo'] = render($vars['content']['field_paragraph_text_logo']);
  $template = 'logo_item';
  nkf_base_paragraph_set_theme($vars, $template);
}

/*
* Card
*/

function nkf_base_preprocess_entity_paragraphs_item_card(&$vars){
  $vars ['overlay_header'] = render($vars['content']['field_paragraph_text_overlay1']);
  $vars ['overlay_subheader'] = render($vars['content']['field_paragraph_text_overlay2']);
  $vars ['image'] = nkf_base_style_image($vars['field_base_image'], 'resize', 800, 500,'display--block rounded');
  $vars ['video'] = render($vars['content']['field_paragraph_video']);
  $vars ['headline'] = render($vars['content']['field_paragraph_title']);
  $vars ['body'] = render($vars['content']['field_base_description']);
  $vars['more'] = render($vars['content']['field_base_link']);
  nkf_base_set_css_wrapper($vars, 'narrow');
  $template = 'card';
  nkf_base_paragraph_set_theme($vars, $template);
}

/*
* Card: Job & Volunteer Opportunities
*/

function nkf_base_preprocess_entity_paragraphs_item_opportunity_item(&$vars){
  $vars ['image'] = nkf_base_style_image($vars['field_base_image'], 'resize', 800, 500,'display--block rounded');
  $vars ['op_type'] = $vars['field_base_opportunity_type'][0]['value'];
  $vars ['headline'] = render($vars['content']['field_paragraph_title']);
  $vars ['location'] = render($vars['content']['field_base_city']);
  $vars ['body'] = render($vars['content']['field_base_description']);
  $vars['more'] = render($vars['content']['field_base_link']);
  nkf_base_set_css_wrapper($vars, 'narrow');
  $template = 'opportunity_item';
  nkf_base_paragraph_set_theme($vars, $template);
}

/*
* Job/Volunteer Opportunities section
*/

function nkf_base_preprocess_entity_paragraphs_item_opportunity_section(&$vars){
  foreach(element_children($vars['content']['field_opportunity_item_complex']) as $item) {
    $vars['items'][] = render($vars['content']['field_opportunity_item_complex'][$item]);
  }
  $vars['header'] = render($vars['content']['field_paragraph_title']);
  $vars['subheader'] = render($vars['content']['field_base_description']);
  $vars['more'] = render($vars['content']['field_base_link']);
  nkf_base_set_css_wrapper($vars, 'wide');
  $template = 'opportunity_section';
  nkf_base_paragraph_set_theme($vars, $template);
}