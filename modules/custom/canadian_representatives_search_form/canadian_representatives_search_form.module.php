<?php
/**
 * Implements hook_theme().
 */
function canadian_representatives_search_form_theme($existing, $type, $theme, $path) {
  
  return [
    'mythemename' => [
      'render element' => 'form',
      'template' => 'my-template-name',
    ],
  ];
}