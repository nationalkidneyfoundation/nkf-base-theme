<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<!DOCTYPE html>
<head profile="<?php print $grddl_profile; ?>">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <meta name="MobileOptimized" content="width">
  <meta name="HandheldFriendly" content="true">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/<?php print path_to_theme(); ?>/icons/apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/<?php print path_to_theme(); ?>/icons/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/<?php print path_to_theme(); ?>/icons/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/<?php print path_to_theme(); ?>/icons/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/<?php print path_to_theme(); ?>/icons/apple-touch-icon-60x60.png" />
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/<?php print path_to_theme(); ?>/icons/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/<?php print path_to_theme(); ?>/icons/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/<?php print path_to_theme(); ?>/icons/apple-touch-icon-152x152.png" />
  <link rel="icon" type="image/png" href="/<?php print path_to_theme(); ?>/icons/favicon-196x196.png" sizes="196x196" />
  <link rel="icon" type="image/png" href="/<?php print path_to_theme(); ?>/icons/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/png" href="/<?php print path_to_theme(); ?>/icons/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="/<?php print path_to_theme(); ?>/icons/favicon-16x16.png" sizes="16x16" />
  <link rel="icon" type="image/png" href="/<?php print path_to_theme(); ?>/icons/favicon-128.png" sizes="128x128" />
  <meta name="application-name" content="&nbsp;"/>
  <meta name="msapplication-TileColor" content="#FFFFFF" />
  <meta name="msapplication-TileImage" content="/<?php print path_to_theme(); ?>/icons/mstile-144x144.png" />
  <meta name="msapplication-square70x70logo" content="/<?php print path_to_theme(); ?>/icons/mstile-70x70.png" />
  <meta name="msapplication-square150x150logo" content="/<?php print path_to_theme(); ?>/icons/mstile-150x150.png" />
  <meta name="msapplication-wide310x150logo" content="/<?php print path_to_theme(); ?>/icons/mstile-310x150.png" />
  <meta name="msapplication-square310x310logo" content="/<?php print path_to_theme(); ?>/icons/mstile-310x310.png" />

  <?php print $styles; ?>
  <?php print $scripts; ?>
  <script>
    // crazy hack for testing if IE 8 or below
    var ie8 = false;
  </script>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script>
      ie8 = true;
    </script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>
