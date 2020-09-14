<?php

namespace Drupal\canadian_representatives_search_form\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;

class RepresentativesSearchForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId(){
        return 'canadian_representatives_search_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state){
        
        $form['postal_code'] = [
            '#type' => 'textfield',
            "#title" => $this->t('Postal Code'),
        ];

        $header = array(t('Representative Group'));
        if (!empty($form_state->getValue('postal_code'))) {
          $header = array(t('Representative Group'), t('Office'), t('Name'));
        }
        $rows = array(); 
          
        $form['submit'] = [
          '#type' => 'submit',
          "#value" => $this->t('Search'),
      ];

        $form['example_table'] = [
            '#type' => 'table',
            '#header' => $header,
            '#empty' => $this->t('Some text'),
            '#rows' => $this->getTableRows($header, $form_state),
          ];
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state){

        $form_state->setValue('postal_code', $form_state->getValue('postal_code'));
        $form_state->setRebuild(TRUE);
    }

    public function getTableRows(array $header, FormStateInterface $form_state){

      $client = \Drupal::httpClient();
      if(!isset($form_state) || $form_state->getValue('postal_code') == null){
        $url = 'http://represent.opennorth.ca/representative-sets/';
      }else{
        $url = 'http://represent.opennorth.ca/postcodes/'.$form_state->getValue('postal_code');
      }
      $request = $client->get($url);
      $response = json_decode($request->getBody(), true);

      $rows = array();
      if(!isset($form_state) || $form_state->getValue('postal_code') == null){
        foreach($response['objects'] as $representative){
          $rows[] = array($representative['name']);
        }
      }else{
        foreach($response['representatives_centroid'] as $representative){
          $rows[] = array($representative['representative_set_name'], $representative['elected_office'], $representative['name']);
        }
      }

      return $rows;
    } 
}