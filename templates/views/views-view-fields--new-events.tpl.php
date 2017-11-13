<?php

$path = $fields['path']->content;
$title = $fields['title']->content;
$month = $fields['field_base_date_time']->content;
$day = $fields['field_base_date_time_1']->content;
$img_src = $fields['field_event_hero_image']->content;
$title_prefix = $fields['field_base_address_locality']->content;
$title_prefix .= ', ' . $fields['field_base_address_administrative_area']->content;

$bg_color = 'bg--gray-1';


include(NKF_BASE_PATH . '/templates/cards/card-pic-date.tpl.php');
//include(drupal_get_path('theme', 'nkf_base').'/templates/partials/list-pic.tpl.php');
