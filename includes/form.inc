<?php


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
  }
}
