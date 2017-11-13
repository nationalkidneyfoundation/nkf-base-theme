<?php

/**
 * @file
 * This template handles the layout of the views exposed filter form.
 *
 * Variables available:
 * - $widgets: An array of exposed form widgets. Each widget contains:
 * - $widget->label: The visible label to print. May be optional.
 * - $widget->operator: The operator for the widget. May be optional.
 * - $widget->widget: The widget itself.
 * - $sort_by: The select box to sort the view using an exposed form.
 * - $sort_order: The select box with the ASC, DESC options to define order. May be optional.
 * - $items_per_page: The select box with the available items per page. May be optional.
 * - $offset: A textfield to define the offset of the view. May be optional.
 * - $reset_button: A button to reset the exposed filter applied. May be optional.
 * - $button: The submit button for the form.
 *
 * @ingroup views_templates
 */
 $widget = $widgets['filter-field_geofield_distance'];

?>
<?php if (!empty($q)): ?>
  <?php
    // This ensures that, if clean URLs are off, the 'q' is added first so that
    // it shows up first in the URL.
    print $q;
  ?>
<?php endif; ?>
<a id="event-search"></a>
<div class="display--inline-block max-width--xxl padding--sm">
  <?php if (!empty($widget->label)): ?>
    <h2 class="padding--none">
      <?php print $widget->label; ?>
    </h2>
  <?php endif; ?>
  <div class="sm--display--table width--100">
    <div class="sm--display--table-cell vertical-align--top display--block width--100">

      <?php print $widget->widget; ?>
      <?php if (!empty($widget->description)): ?>
        <div class="description">
          <?php print $widget->description; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="sm--display--table-cell vertical-align--top display--block sm--width--auto width--100 sm--padding--none sm--padding-top--sm sm--padding-left--sm">
      <?php print $button; ?>
    </div>
  </div>
</div>
