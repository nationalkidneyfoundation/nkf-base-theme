<?php


/**
 * Implementsof hook_form_alter
 */

function nkf_base_form_alter(&$form, &$form_state, $form_id) {
  //dpm($form);

  if($form_id == 'page_node_form') {
    //$form['field_ia_category'][LANGUAGE_NONE]['#options'][42994] = '<span class="padding-left--xl">test</span>';
    $form['field_ia_category'][42994] = array(
      '#type' => 'checkbox',
      '#return_value' => 42994,
      '#default_value' => 42994,
      '#attributes' => array('class' => array('margin-left--md')),
    );
  }

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
