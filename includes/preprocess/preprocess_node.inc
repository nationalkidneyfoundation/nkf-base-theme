<?php

/**
 * Implements theme_preprocess_node().
 */
function nkf_base_preprocess_node(&$vars) {
  $node = $vars['node'];
  $wrapper = entity_metadata_wrapper('node', $node);

  $vars['section_classes'] = '';
  $vars['hero_classes'] = '';
  if (isset($wrapper->field_color_theme) && !empty($wrapper->field_color_theme->value())) {
    $vars['th'] = nkf_base_color_theme_helper($wrapper->field_color_theme->value());
  }
  if ($vars['type'] == 'panel' || $vars['type'] == 'page') {
    if ($vars['content_attributes_array'] && $vars['content_attributes_array']['class']) {
      $vars['content_attributes_array']['class'] = array_diff($vars['content_attributes_array']['class'], array('prose'));
    }
  }

  if ($vars['type'] == 'new_event') {

    // Sticky Nav.
    $vars['sections'] = array(
      'top' => array(
        'include' => true,
        'title' => 'Top'
      ),
      'about' => array(
        'include' => true,
        'title' => 'About This Event'
      ),
      'vip1' => array(
        'include' => $wrapper->field_event_vip1_toggle->value(),
        'title' => $wrapper->field_event_vip1_title->value()
      ),
      'vip2' => array(
        'include' => $wrapper->field_event_vip2_toggle->value(),
        'title' => $wrapper->field_event_vip2_title->value()
      ),
      'vip3' => array(
        'include' => $wrapper->field_event_vip3_toggle->value(),
        'title' => $wrapper->field_event_vip3_title->value()
      ),
      'auction' => array(
        'include' => $wrapper->field_event_auction_toggle->value(),
        'title' => $wrapper->field_event_auction_title->value()
      ),
      'location' => array(
        'include' => $wrapper->field_event_location_toggle->value(),
        'title' => $wrapper->field_event_location_title->value()
      ),
      'volunteer' => array(
        'include' => $wrapper->field_event_volunteer_toggle->value(),
        'title' => $wrapper->field_event_volunteer_title->value(),
      ),
      'photos' => array(
        'include' => $wrapper->field_event_photos_toggle->value(),
        'title' => $wrapper->field_event_photos_title->value()
      ),
      'aboutnkf' => array(
        'include' => true,
        'title' => $wrapper->field_event_branding_title->value()
      ),
    );


    if (isset($wrapper->field_event_hero_image) && !empty($wrapper->field_event_hero_image->value())) {
      $vars['hero_url'] = nkf_base_image_url($wrapper->field_event_hero_image, 'extra_large_landscape');
    }
    if (isset($wrapper->field_base_address)) {
      $vars['city'] = $wrapper->field_base_address->locality->value();
      $vars['state'] = $wrapper->field_base_address->administrative_area->value();
      $vars['zip'] = $wrapper->field_base_address->postal_code->value();
      $vars['street'] = $wrapper->field_base_address->thoroughfare->value();
      $vars['street2'] = $wrapper->field_base_address->premise->value();
      $vars['address_url'] = urlencode($vars['street'] . ' ' . $vars['city'] . ' ' . $vars['state'] . ' ' . $vars['zip']);
    }
    if (isset($wrapper->field_base_geofield) && !empty($wrapper->field_base_geofield->value())) {
      $vars['longitude'] = $wrapper->field_base_geofield->lon->value();
      $vars['latitude'] = $wrapper->field_base_geofield->lat->value();
    }

    if (isset($wrapper->field_event_cta) && !empty($wrapper->field_event_cta->value())) {
      foreach ($wrapper->field_event_cta as $i => $cta) {
        $vars['ctas'][] = array(
          'url' => $cta->url->value(),
          'title' => $cta->title->value(),
          'button' => ($i == 0) ? $vars['th']['header_button_1'] : $vars['th']['header_button_2']
        );
      }
    }

    if (module_exists('kidneys_misc')) {
      $vars['social_actions'] = kidneys_misc_get_content_actions();
    }
    /*
    if (isset($wrapper->field_event_vip_1) && !empty($wrapper->field_event_vip_1->value())) {
      foreach ($wrapper->field_event_vip_1 as $key => $value) {
        $vars['photos'][] = array(
          'src_thumb' => nkf_base_image_url($value, 'square_thumbnail'),
          'src_full' => nkf_base_image_url($value),
          'title' => $value->value()['title'],
          'alt' => $value->value()['alt'],
        );
      }
    }
    */

    if (isset($wrapper->field_event_event_photos1) && !empty($wrapper->field_event_event_photos1->value())) {
      foreach ($wrapper->field_event_event_photos1 as $key => $value) {
        $vars['photos'][] = array(
          'src_thumb' => nkf_base_image_url($value, 'square_thumbnail'),
          'src_full' => nkf_base_image_url($value),
          'title' => $value->value()['title'],
          'alt' => $value->value()['alt'],
        );
      }
    }

    if (isset($wrapper->field_event_header_font) && !empty($wrapper->field_event_header_font->value())) {
      $header_font = $wrapper->field_event_header_font->value();
      $header_font_url = str_replace(' ','+', $header_font);
      $css = '@import url("https://fonts.googleapis.com/css?family=' . $header_font_url . '");';
      $css .= 'h1,h2,h3,h4 { font-family: ' . $header_font . ' !important; font-weight: normal !important}';
      drupal_add_css($css, 'inline');
    }

    if (isset($wrapper->field_base_hero_divider) && !empty($wrapper->field_base_hero_divider->value())) {
      $vars['hero_classes'] .= $wrapper->field_base_hero_divider->value();
    }
    if (isset($wrapper->field_base_section_divider) && !empty($wrapper->field_base_section_divider->value())) {
      if (isset($wrapper->field_color_theme) && !empty($wrapper->field_color_theme->value())) {
        $svg_color = nkf_base_color_hex_from_name($wrapper->field_color_theme->value());
      } else {
        $svg_color = nkf_base_color_hex_from_name();
      }
      $vars['section_classes'] .= 'edge--icon--bottom';
      $icon_name = $wrapper->field_base_section_divider->value();
      $svg_file = file_get_contents(NKF_BASE_PATH . "/svg/$icon_name.svg");
      $svg_file = trim($svg_file);
      $svg_file = str_replace(array("\n", "\t", "\r"), '', $svg_file);
      $svg_url = 'data:image/svg+xml;utf8,' . str_replace('<svg','<svg fill="'.$svg_color.'"',$svg_file);
      $css = '.edge--icon--bottom:after { background-image: url(\'' . $svg_url . '\'); }';
      drupal_add_css($css, 'inline');
    }

    $vars['has_nav_sub'] = true;
    $vars['sub_nav_title'] = $node->title;
    $vars['sub_nav_actions'] = $vars['social_actions'];

  }
}
