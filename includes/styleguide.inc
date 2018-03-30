<?php

/**
 * Implementsof hook_styleguide
 */
function nkf_base_styleguide_alter(&$items) {
  //dpm($items);
  $items['list_accordion'] = array(
    'title' => t('List: Accordion'),
    'theme' => 'list_accordion',
    'description' => 'this is a description',
    'variables' => array('items' => array(
      array(
        'title' => 'title',
        'description' => 'content',
        'iid' => '1',
      ),
      array(
        'title' => 'title',
        'description' => 'content',
        'iid' => '2',
      )
    )),
    'group' => t('Common'),
  );
  /*
  $items['text'] = array(
    'title' => t('Text block'),
    'content' => styleguide_paragraph(3),
    'group' => t('Text'),
    'description' => t('A block of three paragraphs'),
  );
  $items['h1'] = array(
    'title' => t('Text block'),
    'tag' => 'h1',
    'content' => styleguide_word(3),
    'group' => t('Text'),
  );
  $items['div-format'] = array(
    'title' => t('Div special'),
    'description' => t('Add the "format" class to emphasize an entire section.'),
    'tag' => 'div',
    'attributes' => array('class' => 'format'),
    'content' => styleguide_paragraph(1),
  );
  */
  //return $items;
}

/**
 * Implements theme_styleguide_item
 */
function nkf_base_styleguide_item($variables) {
  $key = $variables['key'];
  $item = $variables['item'];
  $content = $variables['content'];
  $output = '';
  $output .= "<a name=\"$key\"></a>";
  $output .= '<h3 class="caps">'. $item['title'] .'</h3>';
  if (!empty($item['description'])) {
    $output .= '<p class="">';
    $output .= $item['description'];
    $output .= '</p>';
  }
  $output .= '<div class="padding-bottom--md">';
  $output .= $content;
  $output .= '</div>';
  return $output;
}

/**
 * Theme the page links.
 *
 * NOTE: these may be turned into sub-tabs.
 *
 * @param $variables
 *   The theme variables array, including:
 *   -- 'items' the list of links.
 */
function nkf_base_styleguide_links($variables) {
  $output = '<div class="sm--width--20 width--100 z-index--100 bg--gray-1 border-right sm--cover-fixed overflow-y--auto">';
  $output .= '<div>sfd</div>';
  $output .= $variables['items'];
  $output .= '</div>';
  return $output;
}

function nkf_base_preprocess_styleguide_links(&$vars) {
  //dpm($vars,'preprocess styleguide links');
}
function nkf_base_preprocess_styleguide_content(&$vars) {
  //dpm($vars,'preprocess styleguide content');
}
function nkf_base_preprocess_styleguide_header(&$vars) {
  //dpm($vars,'preprocess styleguide header');
}
