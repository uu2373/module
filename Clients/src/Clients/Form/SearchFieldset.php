<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Search
 *
 * @author AShvager
 */
namespace Clients\Form;
use Clients\Entity\Search;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class SearchFieldset extends Fieldset implements InputFilterProviderInterface{
 public function __construct(){
   parent::__construct('SearchFieldset');
   $this->setHydrator(new ClassMethodsHydrator(false))
            ->setObject(new Search());
   $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Search'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

 }
 //put your code here
 public function getInputFilterSpecification() {
    return array(
            'name' => array(
                'required' => true,
            )
        );
 }
}

?>
