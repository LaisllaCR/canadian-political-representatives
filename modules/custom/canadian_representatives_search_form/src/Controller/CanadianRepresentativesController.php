<?php

namespace Drupal\canadian_representatives_search_form\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines CanadianRepresentativesController class.
 */
class CanadianRepresentativesController extends ControllerBase {

  /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */
  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello, World!'),
    ];
  }

}