<?php


/**
 * Implementsof hook_form_element_label
 */
function nkf_base_form_element_label($vars) {
  if (strpos($vars['element']['#id'],'edit-field-ia-category') !== false &&
      strpos($vars['element']['#title'],'-') === 0) {
      $element = $vars['element'];
      $t = get_t();
      $title = filter_xss_admin($element['#title']);
      $c = substr_count($vars['element']['#title'], '-', 0, 4);
      $c = $c * 20;
      $attributes = array();
      $attributes['style'] = 'margin-left: ' . $c . 'px;';

      // Style the label as class option to display inline with the element.
      if ($element['#title_display'] == 'after') {
        $attributes['class'] = 'option';
      }
      elseif ($element['#title_display'] == 'invisible') {
        $attributes['class'] = 'element-invisible';
      }
      if (!empty($element['#id'])) {
        $attributes['for'] = $element['#id'];
      }

      // The leading whitespace helps visually separate fields from inline labels.
      return ' <label' . drupal_attributes($attributes) . '>' . $t('!title !required', array(
        '!title' => $title,
        '!required' => $required,
      )) . "</label>\n";

  } else {
    return theme_form_element_label($vars);
  }




}

/**
 * Implementsof hook_form_alter
 */

function nkf_base_form_alter(&$form, &$form_state, $form_id) {
  if($form_id == 'views_exposed_form'){
    $view = $form_state['view'];
    // Modify the exposed filter for search type views.
    if ($view->name == 'search_results_subsection' || $view->name == 'new_events') {
      $form['search']['#attributes'] =
        array(
          'class' => array('width--100'),
      );
      $form['submit']['#attributes'] =
        array(
          'class' => array('width--100', 'button--gray-4'),
      );
    }
    if ($view->name == 'golf_teams') {
      $form['c']['#attributes'] =
        array(
          'class' => array('width--100'),
          'placeholder' => t('Search by team or captain name')
        );
      $form['submit']['#attributes'] =
        array(
          'class' => array('width--100', 'button--gray-4'),
      );
    }
  }
}
