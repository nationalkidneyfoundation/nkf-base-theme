<?php


/*
 * Helper function to print field without markup.
*/
function print_field($field) {
  //$entity_id = $item['value'];
  $wrapper = entity_metadata_wrapper($field['#entity_type'], $field['#object']);
  $field_value = $wrapper->{$field['#field_name']}->value();
  print ($field_value);
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
    'white' => array(
      'primary_color' => 'white',
      'header' => 'bg--white color--gray-4 logo--ob',
      'nav' => 'bg--white',
      'hero' => 'color--gray-4 bg--white',
      'odd_section' => 'bg--gray-1',
      'header_button_1' => 'button--orange',
      'header_button_2' => 'button--gray-1'
    ),
  );
  return $themes[$name];
}

function nkf_base_include_slick() {
  drupal_add_library('nkf_base', 'slick');
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
