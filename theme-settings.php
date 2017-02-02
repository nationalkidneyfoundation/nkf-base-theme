<?php


function nkf_base_form_system_theme_settings_alter(&$form, $form_state) {
  $form['nkf_base_version_2_paths'] = array(
    '#type'          => 'textarea',
    '#title'         => t('Paths for version Two'),
    '#default_value' => theme_get_setting('nkf_base_version_2_paths'),
    '#description' => t("Enter one page per line as Drupal paths. The '*' character is a wildcard. Example paths are %blog for the blog page and %blog-wildcard for every personal blog. %front is the front page. Read <a href=\"http://api.drupal.org/api/function/drupal_match_path/6\">drupal_match_path()</a> for the details.", array('%blog' => 'blog', '%blog-wildcard' => 'blog/*', '%front' => '<front>')),
  );
}
