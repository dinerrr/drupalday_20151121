<?php
/**
 * @file
 * table.vars.php
 */

/**
 * Implements hook_preprocess_table().
 */
function bootstrap_preprocess_table(&$variables) {
  // Prepare classes array if necessary.
  if (!isset($variables['attributes']['class'])) {
    $variables['attributes']['class'] = array();
  }
  // Convert classes to an array.
  elseif (isset($variables['attributes']['class']) && is_string($variables['attributes']['class'])) {
    $variables['attributes']['class'] = explode(' ', $variables['attributes']['class']);
  }

  // Add the necessary classes to the table.
  _bootstrap_table_add_classes($variables['attributes']['class'], $variables);
}

/**
 * Helper function for adding the necessary classes to a table.
 *
 * @param array $classes
 *   The array of classes, passed by reference.
 * @param array $variables
 *   The variables of the theme hook, passed by reference.
 */
function _bootstrap_table_add_classes(&$classes, &$variables) {
  $context = $variables['context'];

  // Generic table class for all tables.
  $classes[] = 'table';

  // Bordered table.
  if (!empty($context['bordered']) || bootstrap_setting('table_bordered')) {
    $classes[] = 'table-bordered';
  }

  // Condensed table.
  if (!empty($context['condensed']) || bootstrap_setting('table_condensed')) {
    $classes[] = 'table-condensed';
  }

  // Hover rows.
  if (!empty($context['hover']) || bootstrap_setting('table_hover')) {
    $classes[] = 'table-hover';
  }

  // Striped rows.
  if (!empty($context['striped']) || bootstrap_setting('table_striped')) {
    $classes[] = 'table-striped';
  }

  $variables['responsive'] = !empty($context['responsive']) ? $context['responsive'] : bootstrap_setting('table_responsive');
}
