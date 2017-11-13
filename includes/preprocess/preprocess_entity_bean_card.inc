<?php

/*
 *
 */
function nkf_base_preprocess_entity_bean_card(&$vars) {
  $type= $vars['entity_type'];

  $vars['media_orientation'] = $media_orientation = (!empty($vars[$type]->field_card_media_orientation[LANGUAGE_NONE])) ? $vars[$type]->field_card_media_orientation[LANGUAGE_NONE][0]['value'] : FALSE;
  $vars['media_size'] = $media_size = (!empty($vars[$type]->field_card_media_size[LANGUAGE_NONE])) ? $vars[$type]->field_card_media_size[LANGUAGE_NONE][0]['value'] : FALSE;
  $vars['height'] = $height = (!empty($vars[$type]->field_card_height[LANGUAGE_NONE])) ? $vars[$type]->field_card_height[LANGUAGE_NONE][0]['value'] : FALSE;
  $vars['url'] = $url = (!empty($vars[$type]->field_base_link[LANGUAGE_NONE])) ? $vars[$type]->field_base_link[LANGUAGE_NONE][0]['url'] : FALSE;

  if (isset($vars[$type]->field_card_action_links[LANGUAGE_NONE])) {
    $_d = count($vars[$type]->field_card_action_links[LANGUAGE_NONE]);
  }
  $_d = 1;
  $vars['action_links_width'] = floor((1 / $_d) * 100);

  $vars['bg_color'] = $bg_color = (!empty($vars[$type]->field_card_bg_color[LANGUAGE_NONE])) ? $vars[$type]->field_card_bg_color[LANGUAGE_NONE][0]['value'] : FALSE;
  $vars['text_color'] = $text_color = (preg_match('/gray-5|blue|navy|red|aqua|green|sienna/', $bg_color))? 'white' : 'black';

  $vars['action_links'] = array();
  if (!empty($vars[$type]->field_card_action_links[LANGUAGE_NONE])) {
    foreach($vars[$type]->field_card_action_links[LANGUAGE_NONE] as $l) {
      $l['attributes']['class'][] = 'color--' . $text_color;
      $l['attributes']['class'][] = 'display--block';
      $l['attributes']['class'][] = 'padding--sm';
      $vars['action_links'][] = l($l['title'], $l['url'], $l);
    }
  }

  $title = render($vars[$type]->title);
  $vars['title'] = $title;

  $description = (!empty($vars[$type]->field_base_description[LANGUAGE_NONE])) ? $vars[$type]->field_base_description[LANGUAGE_NONE][0] : FALSE;
  if ($description) {
    $d = field_view_value('bean', $vars['bean'], 'field_base_description', $description);
    $description = render($d);
    $vars['description'] = $description;
  }


  if(!empty($vars[$type]->field_base_image[LANGUAGE_NONE]) && $image = $vars[$type]->field_base_image[LANGUAGE_NONE][0]['uri']) {
    $media_uri = $image;
  }

  if(!empty($vars[$type]->field_card_video[LANGUAGE_NONE]) && $video = $vars[$type]->field_card_video[LANGUAGE_NONE][0]) {
    $video_settings = array('type'=>'video_embed_field_thumbnail');
    $video_info = field_view_value('bean', $vars['bean'], 'field_card_video', $video, $video_settings);
    $_v = field_view_value('bean', $vars['bean'], 'field_card_video', $video);
    $video_embed = render($_v);
    $vars['video_embed'] = $video_embed;
    $media_uri = $video_info['#item']['uri'];
    //$vars['video'] = render(field_view_value('bean', $vars['bean'], 'field_card_video', $video, $video_settings));
  }

  if (!empty($vars[$type]->field_card_caption[LANGUAGE_NONE]) && $caption = $vars[$type]->field_card_caption[LANGUAGE_NONE][0]) {
    $_c = field_view_value('bean', $vars['bean'], 'field_card_caption', $caption);
    $vars['caption'] = render($_c);
  }


  $media_classes = array();
  $content_classes = array();
  $vars['flavor'] = 'media-top';
  if (!empty($media_uri)) {
    if ($media_orientation == 'l' || $media_orientation == 'r') {
      $media_classes[] = 'height--100';
      $media_classes[] = 'width--' . $media_size;
      $vars['flavor'] = ($media_orientation == 'l') ? 'media-left' : 'media-right';
      if(preg_match('/lg|xl/',$media_size)) {
        $image_style = 'card-standard';
      } else if($media_size == 'md') {
        $image_style = 'card-standard';
      } else if ($media_size == 'sm'){
        $image_style = 'card-portrait';
      }
    } else {
      $media_classes[] = 'width--100';
      $media_classes[] = 'height--' . $media_size;
      $vars['flavor'] = ($media_orientation == 't') ? 'media-top' : 'media-bottom';
      if(preg_match('/lg|xl/',$media_size)) {
        $image_style = 'card-standard';
      } else if($media_size == 'md') {
        $image_style = 'card-landscape';
      } else if ($media_size == 'sm'){
        $image_style = 'card-landscape';
      }
    }
    $vars['media_uri'] = nkf_base_image_url($media_uri, $image_style);
  }

  //$vars['media'] = $media;
  $vars['classes_plus'] = array();
  $vars['classes_plus'][] = 'bg--' . $bg_color;
  $vars['classes_plus'][] = 'color--' . $text_color;




  if ($height) {
    $vars['classes_plus'][] = 'height--' . $height;
  }

  $vars['classes_plus'] = implode(' ', $vars['classes_plus']);
  $vars['media_classes'] = implode(' ', $media_classes);
  $vars['random'] = user_password();

}
