<?php

/**
 * Implements hook_preprocess_field
 */
function nkf_base_preprocess_field(&$vars, $hook) {
  // Style promo block for New Event content
  if ($vars['element']['#field_name'] == 'field_promo_block' ) {
    $promo = $vars['element']['#object'];
    $promo_wrapper = entity_metadata_wrapper('node', $promo);
    // Check that we have a related event
    if (!empty($promo_wrapper->field_base_related_entity->value())) {
      $event_wrapper = entity_metadata_wrapper('node', $promo_wrapper->field_base_related_entity[0]->value());
      nkf_base_event_card_theme_helper($vars, $event_wrapper);
      $vars['theme_hook_suggestions'][] = 'card_pic_date';
    }
  }
  // Hack into the field collection for VIP section on events.
  if ($vars['element']['#field_type'] == 'field_collection') {
    $fields = field_info_instances('field_collection_item', $vars['element']['#field_name']);
    $field_array = array_keys($fields);
    nkf_base_rows_from_field_collection($vars, $field_array);
    if (in_array($vars['element']['#field_name'], array('field_event_vip_1','field_event_vip_2', 'field_event_vip_3'))) {
      $groups = array();
      foreach($vars['rows'] as $row) {
        $groups[strtoupper($row['field_vip_subsection_text'])][] = $row;
      }
      $vars['rows'] = $groups;
    }
  }
}

/**
 * Creates a simple text rows array from a field collections, to be used in a
 * field_preprocess function.
 * https://www.fourkitchens.com/blog/article/better-way-theme-field-collections/
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 *
 * @param $field_name
 *   The name of the field being altered.
 *
 * @param $field_array
 *   Array of fields to be turned into rows in the field collection.
 */
function nkf_base_rows_from_field_collection(&$vars, $field_array) {
  $vars['rows'] = array();
  foreach($vars['element']['#items'] as $key => $item) {
    $entity_id = $item['value'];
    $entity = field_collection_item_load($entity_id);
    $wrapper = entity_metadata_wrapper('field_collection_item', $entity);
    $row = array();
    foreach($field_array as $field) {
      $info = $wrapper->$field->info();
      $type = $info['type'];
      $field_value = $wrapper->$field->value();
      switch ($type) {
        case 'text_formatted':
          $value = $wrapper->$field->value->value();
          break;
        case 'field_item_image':
          if (isset($field_value)) {
            $build = array(
              '#theme' => 'image',
              '#path' => $field_value['uri'],
              '#url' => nkf_base_image_url($field_value['uri'], 'large'),
              '#alt' => $field_value['alt'],
              '#title' => $field_value['title'],
              //'#width' => $field_value['width'],
              //'#height' => $field_value['height'],
            );
            $value = $build;
          } else {
            $value = null;
          }
          break;
        default:
          $value = isset($field_value) ? $wrapper->$field->value() : null;

      }
      $row[$field] = $value;
    }
    $vars['rows'][] = $row;
  }
}

/*
 * Helper function to extract theme values from New Event for a card.
 *
 * @param array $vars Template variables
 * @param entity_field_wrapper $event Entity field wrapper for New Event Node.
 */
function nkf_base_event_card_theme_helper(&$vars, $event) {
  $vars['path'] = drupal_get_path_alias('node/' . $event->getIdentifier());
  $vars['title'] = $event->title->value();
  $date = $event->field_base_date_time->value->value();
  $vars['img_src'] = nkf_base_image_url($event->field_event_hero_image->value()['uri'], 'scale_crop', 500, 350);
  $vars['month'] = date_format($date, 'M');
  $vars['month'] = date("M", $date);
  $vars['day'] = date_format($date, 'j');
  $vars['day'] = date("j", $date);
  $vars['title_prefix'] = $event->field_base_address->locality->value();
  $vars['title_prefix'] += ', ' . $event->field_base_address->administrative_area->value();
  $vars['bg_color'] = 'bg--gray-1';
}
