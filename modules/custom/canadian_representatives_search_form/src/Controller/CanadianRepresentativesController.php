<?php

namespace Drupal\canadian_representatives_search_form\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Render\Markup;

/**
 * Defines CanadianRepresentativesController class.
 */
class CanadianRepresentativesController extends ControllerBase {

  /**
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */  
  public function renderForm() {

    $myForm = $this->formBuilder()->getForm('Drupal\canadian_representatives_search_form\Form\RepresentativesSearchForm');
    $renderer = \Drupal::service('renderer');
    $myFormHtml = $renderer->render($myForm);

    $msg = "A representative set is a group of elected officials, like the House of Commons or Toronto City Council.";

    return [
        '#theme' => 'representatives_search_page',
        '#msg' => $msg,
        '#form' => $myForm,
        '#attached' => [
          'library' => [
            'canadian_representatives_search_form/canadian_representatives_search_form-styles', 
          ]
          ],
    ];
  }

}