<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Clients\Form;
//use Clients\Form\SearchFieldset;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

/**
 * Description of Search
 *
 * @author AShvager
 */
class SearchForm extends Form{
 public function __construct(){
  parent::__construct('Search');
  $this->setAttribute('method', 'post')
             ->setHydrator(new ClassMethodsHydrator(false))
             ->setInputFilter(new InputFilter());

  $this->add(array(
            'type' => 'Clients\Form\SearchFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Send'
            )
        ));
 }
}

?>
