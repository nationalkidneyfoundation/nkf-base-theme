<?php

/*
 *
 */
function nkf_base_preprocess_entity_bean_hero(&$vars) {
  $type= $vars['entity_type'];

  $horientation = $vars[$type]->field_hero_horientation[LANGUAGE_NONE][0]['value'];
  $vorientation = $vars[$type]->field_hero_vorientation[LANGUAGE_NONE][0]['value'];
  $height = $vars['height'] = $vars[$type]->field_hero_height[LANGUAGE_NONE][0]['value'];

  $description = $vars[$type]->field_base_description[LANGUAGE_NONE][0];
  $description = field_view_value('bean', $vars['bean'], 'field_base_description', $description);
  $vars['description'] = render($description);

  if($image = $vars[$type]->field_base_image[LANGUAGE_NONE][0]['uri']) {
    $image_style = 'hero';
    $media_uri = $image;
    $vars['media_uri'] = nkf_base_image_url($media_uri, $image_style);
  }

  $content_classes = array();
  $content_classes[] = $horientation;
  $content_classes[] = $vorientation;
  $vars['content_classes'] = implode(' ', $content_classes);

}
