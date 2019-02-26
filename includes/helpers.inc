<?php

/*
 * Helper function to get summary information from node.
 *
 * @param Object $node.
 * @return Array keyed with body, image, etc?.
 *
 */
function nkf_base_get_node_meta($node) {
  $return = &drupal_static(__FUNCTION__ . $node->nid, FALSE);
  //if(empty($return)) {

    $wrapper = entity_metadata_wrapper('node', $node);
    $sections = nkf_base_entity_value($wrapper, 'field_paragraph_section');
    if (!$sections) {
      $sections = array();
    }
    $return['title'] = $node->title;
    $return['path'] = url('node/' . $node->nid);
    // Let's get the text information first.
    // 1. Try to get from body.
    if (!empty($body = nkf_base_entity_value($wrapper, 'body'))) {
      // TODO: we should use a render function here.
      $return['desc'] = $body['safe_value'];
    }

    // 2. Try to get field_base_description.
    if (empty($return['desc'])) {
      if (!empty($desc = nkf_base_entity_value($wrapper, 'field_base_description'))) {
        $return['desc'] = $desc;
      } else {
        foreach($sections as $paragraph) {
          if(isset($paragraph->field_base_description)
             && !empty($paragraph->field_base_description[LANGUAGE_NONE][0]['safe_value'])) {
               $return['desc'] = $paragraph->field_base_description[LANGUAGE_NONE][0]['safe_value'];
               break;
          }
        }
      }
    }
    $return['body'] = $return['desc'];
    $alter = array(
      'max_length' => 170, //Integer
      'ellipsis' => TRUE, //Boolean
      'word_boundary' => TRUE, //Boolean
      'html' => FALSE, //Boolean
    );
    $return['teaser'] = views_trim_text($alter, strip_tags($return['desc']));

    // Tagline
    if (!empty($tagline = nkf_base_entity_value($wrapper, 'field_base_tagline'))) {
      $return['tagline'] = $tagline;
    } else {
      // Get first sentence of description.
      // There should be a better way:()
      $return['tagline'] = current(explode(".", strip_tags($return['desc']))) . '.';
    }

    //strip_tags(text_summary($meta_h['desc'], NULL, 200));
    // 3. Do we have a TOC?
    if (!empty($toc = nkf_base_get_toc($node))) {
      $toc = $toc;
      $return['toc'] = $toc;
    }

    // Let's find some images.
    // 1. Find field_base_image.
    if (!empty($image = nkf_base_entity_value($wrapper, 'field_base_image'))) {
      $return['image'] = $image;
    } elseif (!empty($image = nkf_base_entity_value($wrapper, 'field_inline_image'))) {
      $return['image'] = $image;
    } elseif (!empty($image = nkf_base_entity_value($wrapper, 'field_newsletter_image'))) {
      $return['image'] = $image;
    } else {

      foreach($sections as $paragraph) {
        if(isset($paragraph->field_base_image)
           && !empty($paragraph->field_base_image[LANGUAGE_NONE][0])) {
             $return['image'] = $paragraph->field_base_image[LANGUAGE_NONE][0];
             break;
        }
      }
    }

    // What about dates?
    // What about filed in?
    $return['filed_in'] = nkf_base_get_ia_category_links($wrapper);
    //$return['related_content'] = nkf_base_get_node_related_content($node);
  //}
  return $return;
}

/*
 * Helper function to set standard variables for
 * displying nodes in cards, tiles, search, etc.
 *
 * @param Object $node.
 * @param Array $vars.
 *
 */
function nkf_base_set_node_vars($node, &$vars) {
  $meta = nkf_base_get_node_meta($node);
  foreach($meta as $key => $value) {
    $vars[$key] = $value;
  }
}
/*
 * Helper function to get related content from node.
 */
function nkf_base_get_node_related_content($node) {
  if(empty($node)) return;
  $return = &drupal_static(__FUNCTION__ . $node->nid, FALSE);
  if(empty($return)) {
    $nids = array();

    // Get the related content identified on the node itself.
    if(!empty($node->field_base_related_entity)) {
      foreach($node->field_base_related_entity[LANGUAGE_NONE] as $value) {
        $nids[$value['target_id']] = $value['target_id'];
      }
    }
    // Commenting out dynamic related content...might add back at some point.
    /*
    // Get nodes that reference this node directly.
    $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'node');
    $query->propertyCondition('status', NODE_PUBLISHED);
    $query->fieldCondition('field_base_related_entity', 'target_id', $node->nid , '=');
    $result = $query->execute();
    if (isset($result['node'])) {
      foreach($result['node'] as $value) {
          $nids[$value->nid] = $value->nid;
      }
    }

    // Get all nodes that reference this node via a paragraph.
    // TODO: make sure the nodes are published and that the paragraph is published.
    $query = db_select('field_data_field_base_related_entity', 'e');
    $query->leftjoin('field_data_field_paragraph_section', 'p', 'e.entity_id = p.field_paragraph_section_value');
    $query->addField('p', 'entity_id', 'nid');
    $query->condition('e.field_base_related_entity_target_id', $node->nid, '=');
    $query->isNotNull('p.entity_id');
    $result = $query->execute()->fetchAll();
    if (!empty($result)) {
      foreach($result as $value){
        $nids[$value->nid] = $value->nid;
      }

    }*/

    $return = entity_load('node', $nids);
  }
  return $return;
}

/*
 * Helper function to get IA Category terms from node and return in
 * a nice array.
 */
function nkf_base_get_ia_category_links($wrapper) {
  if (!empty($field_values = nkf_base_entity_value($wrapper, 'field_ia_category'))) {
    $return = array();
    foreach($field_values as $value) {
      if(!empty($value->field_base_related_entity)) {
        $nid = $value->field_base_related_entity[LANGUAGE_NONE][0]['target_id'];
        $path = l($value->name, 'node/' . $nid);
      } else {
        $path = l($value->name,'site-search', array('query' => array('f[0]' => 'field_ia_category:'.$value->tid)));
      }
      $return[] = $path;
    }
    return $return;
  } else {
    return NULL;
  }

}

/*
 * Helper to get status for content.
 */
function nkf_base_paragraph_published($paragraph) {
  //return true;
  if (isset($paragraph->field_paragraph_publish)
      && isset($paragraph->field_paragraph_publish[LANGUAGE_NONE][0]['value'])) {

    $item = $paragraph->field_paragraph_publish[LANGUAGE_NONE][0];
    $start_date = new DateObject($item['value'], $item['timezone_db']);
    $now = new DateObject('now', $item['timezone_db']);
    if (isset($paragraph->field_paragraph_unpublish)
        && isset($paragraph->field_paragraph_unpublish[LANGUAGE_NONE][0]['value'])) {
      $end_item = $paragraph->field_paragraph_unpublish[LANGUAGE_NONE][0];
      $end_date = new DateObject($end_item['value'],  $item['timezone_db']);
      return ($start_date <= $now && $now <= $end_date) ? true : false;
    } else {
      return ($start_date <= $now) ? true : false;
    }

  } else {
    return true;
  }

}
/*
 * Helper to get status for content.
 */
function nkf_base_paragraph_status($paragraph) {
  if (isset($paragraph->field_paragraph_publish)
      && isset($paragraph->field_paragraph_publish[LANGUAGE_NONE][0]['value'])) {

    $start = $paragraph->field_paragraph_publish[LANGUAGE_NONE][0];
    $start_date = new DateObject($start['value'], $start['timezone_db']);
    $now = new DateObject('now', $start['timezone_db']);
    if ($now < $start_date) {
      return 'pending';
    }
    if (isset($paragraph->field_paragraph_publish_end)
        && isset($paragraph->field_paragraph_publish_end[LANGUAGE_NONE][0]['value'])) {
      $end = $paragraph->field_paragraph_publish[LANGUAGE_NONE][0];
      $end_date = new DateObject($end['value'], $end['timezone_db']);
      if ($start_date <= $now) {
        if($now <= $end_date) {
          return 'published';
        } else {
          return 'expired';
        }
      }
    }
  } else {
    return 'published';
  }
}

/*
 * Helper to get TOC for content.
 */
function nkf_base_get_toc($node) {
  if (!isset($node->field_base_toc) ||!$node->field_base_toc[LANGUAGE_NONE][0]['value']) {
    return '';
  }
  // Loop through other paragraphs.
  $paragraphs = $node->field_paragraph_section[LANGUAGE_NONE];
  foreach ($paragraphs as $paragraph) {
    $p_ids[] = $paragraph['value'];
  }
  $paragraphs = entity_load('paragraphs_item', $p_ids);
  module_load_include('inc', 'pathauto', 'pathauto');

  foreach ($paragraphs as $paragraph) {
    if (isset($paragraph->field_paragraph_title)
        && isset($paragraph->field_paragraph_title[LANGUAGE_NONE])) {
      $title = field_view_field('paragraphs_item', $paragraph, 'field_paragraph_title',array('label' => 'hidden'));
      $title = strip_tags(render($title));
      $clean_string = pathauto_cleanstring($title);
      $items[] = array(
        'title' => $title,
        'path' => url('node/' . $node->nid, array('fragment'=>$clean_string))
      );
    }
  }
  if (count($items) > 0) {
    //return theme('nkf_base_toc', array('items' => $items));
    return array('items' => $items);
  } else {
    return '';
  }

}

/*
 * Helper function to get menu into links.
 */
function nkf_base_get_menu_links($menu_name) {
  $menu = menu_tree_all_data($menu_name, NULL, 1);
  $return = array();
  foreach($menu as $menu_item) {
    $item = reset($menu_item);
    $return[] = array(
      'name' => $item['link_title'],
      'path' => url($item['link_path']),
    );
  }
  return $return;
}
/*
 * Helper function to print field without markup.
*/
function print_field($field) {
  //$entity_id = $item['value'];
  $wrapper = entity_metadata_wrapper($field['#entity_type'], $field['#object']);
  $field_value = $wrapper->$field['#field_name']->value();
  print ($field_value);
}

/*
 * Helper function to get entity value but avoid errors.
 */
function nkf_base_entity_value($entity, $property, $empty = '') {
  try {
    return ($entity->__isset($property) &&  $entity->{$property}->value()) ? $entity->{$property}->value() : $empty;
  } catch (Exception $e) {
    return '';
  }
}
/*
 * Helper function to get hex code from color name.
*/
function nkf_base_color_hex_from_name($name = 'gray-2') {
  $colors = array(
      'orange' =>     '#F15E22'
    , 'blue' =>       '#1E4497'
    , 'navy' =>       '#26225E'
    , 'red' =>        '#d51217'
    , 'mustard' =>    '#FAAD1D'
    , 'aqua' =>       '#048499'
    , 'yellow' =>     '#FEDC00'
    , 'green' =>      '#018241'
    , 'lime' =>       '#91AE3C'
    , 'sienna' =>     '#9E2420'
    , 'gray-1' =>     '#EDEEEF'
    , 'gray-2' =>     '#DBDDDF'
    , 'gray-3' =>     '#A6AAAF'
    , 'gray-4' =>     '#3b444f'
    , 'gray-5' =>     '#363E48'
    , 'black' =>      '#111'
    , 'twitter' =>    '#4099FF'
    , 'facebook' =>   '#3b5998'
    , 'instagram' =>  '#e95950'
    , 'linkedin' =>   '#4875B4'
    , 'googleplus' => '#C63D2D'
    , 'youtube' =>    '#FF3333'
    , 'pinterest' =>  '#BD081C'
  );
  return $colors[$name];
}


/**
 * Helper function to get theme variables
 *
 * @param String $name The name of the theme to access.
 *
 * @return Array Keyed array of theme vairables.
 */
function nkf_base_color_theme_helper($name = 'standard') {
  $themes = array (
    'standard' => array(
      'primary_color' => 'orange',
      'header' => 'bg--orange color--white logo--wb',
      'nav' => 'bg--orange--l1',
      'hero' => 'bg--gray-1 color--gray-4',
      'odd_section' => 'bg--gray-1',
      'header_button_1' => 'button--orange',
      'header_button_2' => 'button--gray-2',
    ),
    'orange' => array(
      'primary_color' => 'orange',
      'header' => 'bg--orange color--white logo--wb',
      'nav' => 'bg--orange--l1',
      'hero' => 'bg--orange--l1 color--white',
      'odd_section' => 'bg--orange--l2',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--orange',
    ),
    'blue' => array(
      'primary_color' => 'blue',
      'header' => 'bg--blue color--white logo--w',
      'nav' => 'bg--blue--l1',
      'hero' => 'bg--blue--l1 color--white',
      'odd_section' => 'bg--blue--o20',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--blue'
    ),
    'navy' => array(
      'primary_color' => 'navy',
      'header' => 'bg--navy color--white logo--w',
      'nav' => 'bg--navy--l1',
      'hero' => 'bg--navy--l1 color--white',
      'odd_section' => 'bg--navy--o20 color--navy',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--navy'
    ),
    'mustard' => array(
      'primary_color' => 'mustard',
      'header' => 'bg--mustard color--white logo--w',
      'nav' => 'bg--mustard--l1',
      'hero' => 'bg--mustard--l1 color--white',
      'odd_section' => 'bg--mustard--o20 color--gray-4',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--mustard'
    ),
    'aqua' => array(
      'primary_color' => 'aqua',
      'header' => 'bg--aqua color--white logo--w',
      'nav' => 'bg--aqua--l1',
      'hero' => 'bg--aqua--l1 color--white',
      'odd_section' => 'bg--aqua--o20 color--gray-4',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--aqua'
    ),
    'red' => array(
      'primary_color' => 'red',
      'header' => 'bg--red color--white logo--w',
      'nav' => 'bg--red--l1',
      'hero' => 'bg--red--l1 color--white',
      'odd_section' => 'bg--red--o20 color--gray-4',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--red'
    ),
    'green' => array(
      'primary_color' => 'green',
      'header' => 'bg--green color--white logo--w',
      'nav' => 'bg--green--l1',
      'hero' => 'bg--green--l1 color--white',
      'odd_section' => 'bg--green--o20 color--gray-4',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--green'
    ),
    'lime' => array(
      'primary_color' => 'lime',
      'header' => 'bg--lime color--white logo--w',
      'nav' => 'bg--lime--l1',
      'hero' => 'bg--lime--l1 color--white',
      'odd_section' => 'bg--lime--o10 color--gray-4',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--lime'
    ),
    'sienna' => array(
      'primary_color' => 'sienna',
      'header' => 'bg--sienna color--white logo--w',
      'nav' => 'bg--sienna--l1',
      'hero' => 'bg--sienna--l1 color--white',
      'odd_section' => 'bg--sienna--o20 color--gray-4',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--sienna'
    ),
    'gray-5' => array(
      'primary_color' => 'gray-5',
      'header' => 'bg--gray-5 color--white logo--w',
      'nav' => 'bg--gray-4',
      'hero' => 'bg--gray-4 color--white',
      'odd_section' => 'bg--gray-1',
      'header_button_1' => 'button--white',
      'header_button_2' => 'button--gray-5'
    ),
  );
  return $themes[$name];
}


/*
 * Helper function to get a styled image url.
 *
 * @param mixed $value Field from an entity wrapper
 * @param String $name Name of image style
 * @param String $width If on the fly, width.
 * @param String $height If on the fly, height
 *
 * @return String url of image.
 */
 function nkf_base_image_url($value, $name = 'large', $width = FALSE, $height = FALSE) {
   if(empty($value)) {
     return NULL;
   }
   if (is_string($value)) {
     $scheme = file_uri_scheme($value);
     if (!$scheme) {
       // decode url as we will re encode it later through file_create_url
       $image_uri = file_build_uri(basename(urldecode($value)));
     } else {
       $image_uri = $value;
     }
   } else {
     $image_uri = $value->value()['uri'];
   }
   // Try to get an image style on the fly.
   if ($width && $height && $style = nkf_base_image_make_style($name, $width, $height)) {
   } elseif ($style = nkf_base_image_style_load($name)) {
   } else {
     $style = image_style_load($name);
   }
   $style_name = $style['name'];
   $derivative_uri = image_style_path($style_name, $image_uri);
   if (!file_exists($derivative_uri)) {
     image_style_create_derivative($style, $image_uri, $derivative_uri);
   }
   return file_create_url($derivative_uri);
 }

function nkf_base_style_image($field, $name = 'large', $width = FALSE, $height = FALSE, $classes = NULL) {
  $derivative_uri = nkf_base_style_image_url($field, $name, $width, $height, $classes);
  if (empty($derivative_uri)){
    return FALSE;
  }

  if ($classes) {
    $field['attributes']['class'][] = $classes;
  }

  $image_dimensions = getimagesize($derivative_uri);
  $field['path'] = $derivative_uri;
  $field['width'] = $image_dimensions[0];
  $field['height'] = $image_dimensions[1];
  return theme('image', $field);
}

function nkf_base_style_image_url($field, $name = 'large', $width = FALSE, $height = FALSE, $classes = NULL) {
  if(empty($field)) {
    return NULL;
  }
  // Just take the first item, this is probably a dump idea.
  if (isset($field[0])) {
    $field = reset($field);
  }

  // Try to get an image style on the fly.
  if ($width && $height && $style = nkf_base_image_make_style($name, $width, $height)) {
  } elseif ($style = nkf_base_image_style_load($name)) {
  } else {
    $style = image_style_load($name);
  }
  $style_name = $style['name'];
  $derivative_uri = image_style_path($style_name, $field['uri']);

  if (!file_exists($derivative_uri)) {
    image_style_create_derivative($style, $field['uri'], $derivative_uri);
  }
  return $derivative_uri;
}

// DEPRECATED
function nkf_base_get_image_style_url($image_uri, $style_name = 'large') {

  $derivative_uri = image_style_path($style_name, $image_uri);

  if (!file_exists($derivative_uri)) {
    if ($style = nkf_base_image_style_load($style_name)) {
    } else {
      $style = image_style_load($style_name);
    }
    image_style_create_derivative($style, $image_uri, $derivative_uri);
  }
  return file_create_url($derivative_uri);
}

/*
 * Helper function to define and return image styles.
 * Would be better to use hook_image_style but can't in a theme.
 *
 * @param String $name Name of image style
 *
 * @return Array Image style definition.
 */
function nkf_base_image_style_load($name) {
  $styles = array();

  $styles['nkf_base_card_narrow'] = array(
    'label' => 'NKF Base: Card - Narrow',
    'name' => 'nkf_base_card_narrow',
    'effects' => array(
      array(
        'name' => 'scale_and_crop',
        'effect callback' => 'image_scale_and_crop_effect',
        'data' => array('width' => 400, 'height' => 200, 'upscale' => 0),
        'weight' => 0,
      ),
    ),
  );

  return array_key_exists($name, $styles) ? $styles[$name] : FALSE ;
}
/*
 * Helper function to return an image style on the fly.
 *
 * @param String $effect Abbreviation of effect name.
 * @param String $width Width in pixels.
 * @param String $height Height in pixels.
 *
 * @return Array Image style definition.
 */
function nkf_base_image_make_style($effect, $width, $height) {
  $use_smart = module_exists('smartcrop');
  switch ($effect) {
    case 'resize':
      $callback = 'image_scale_and_crop_effect';
      break;
    case 'scale':
      $callback = 'image_scale_effect';
      break;
    case 'scale_crop':
      $callback = $use_smart ? 'smartcrop_scale_effect' : 'image_scale_and_crop_effect';
      break;
    case 'crop':
      $callback = $use_smart ? 'smartcrop_crop_effect' : 'image_crop_effect';
      break;
  }

  if (empty($callback)) {
    return FALSE;
  }

  $style = array();
  $name = 'nkf_base_custom_' . $effect . '_' . $width . '_' .$height;
  $style = array(
    'label' => $name,
    'name' => $name,
    'effects' => array(
      array(
        'name' => $name,
        'effect callback' => $callback,
        'data' => array('width' => $width, 'height' => $height, 'upscale' => 0),
        'weight' => 0,
      ),
    ),
  );
  return $style;
}


/**
 *
 */
function nkf_base_set_page_node_title($node) {
  return nkf_base_is_landing_page($node);
}
/**
 *
 */
function nkf_base_is_landing_page($node) {
  $bundles = array(
    'promo_banner',
    'hero',
    'freeform'
  );
  if (isset($node->field_paragraph_section)
      && isset($node->field_paragraph_section[LANGUAGE_NONE][0]['value'])) {
      $p_id = $node->field_paragraph_section[LANGUAGE_NONE][0]['value'];

      $paragraph = entity_load_single('paragraphs_item', $p_id);
      $bundle = $paragraph->bundle;
      if (in_array($bundle, $bundles)) {
        return TRUE;
      } else {
        return FALSE;
      }
  } else {
    return FALSE;
  }

}

function nkf_base_make_iframe($url) {
  $iframe = '<iframe class="iframe-dynamic-height" src="' . $url . '" width="100%" type="text/html" frameborder="0" allowTransparency="true" style="border: 0"></iframe>';
  return $iframe;
}
