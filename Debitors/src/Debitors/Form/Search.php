<?php

namespace Debitors\Form;

use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Fieldset;
use Zend\Form\Element;
use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;





class Search extends Form {

// protected $captcha;
//
// public function setCaptcha(CaptchaAdapter $captcha) {
//  $this->captcha = $captcha;
// }

 public function __construct() {
  parent::__construct('create_product');

  $this->setAttribute('method', 'post')
      ->setHydrator(new ClassMethodsHydrator(false))
      ->setInputFilter(new InputFilter());

/*  $this->add(array(
    'type' => 'Zend\Form\Element\Collection',
    'name' => 'categories',
    'options' => array(
      'label' => 'Форма поиска',
      'count' => 2,
      'should_create_template' => true,
      'allow_add' => true,
      'target_element' => array(
        'type' => 'Application\Form\CategoryFieldset'
      )
    )
  ));

*/

  $this->add(array(
    'type' => 'Zend\Form\Element\Text',
    'name' => 'search',
    'options' => array(
      'label' => 'Клиент'
    ),
  ));

//            $captcha = new Zend\Form\Element\Captcha('captcha');
//            $captcha->setCaptcha(new Captcha\Dumb());
  /*
    $captcha = new Element\Captcha('captcha');
    $captcha->setCaptcha(new Captcha\Dumb());
    //$captcha->setCaptcha(new Captcha\Image());
    $captcha->setLabel('Please verify you are human');


    $this->add($captcha);
   */

  $this->add(array(
    'type' => 'Zend\Form\Element\Csrf',
    'name' => 'csrf'
  ));

  $this->add(array(
    'name' => 'price',
    'options' => array('label' => 'Price of the product'),
    'attributes' => array('required' => 'required')
  ));


  $this->add(array(
    'name' => 'submit',
    'attributes' => array(
      'type' => 'submit',
      'value' => 'Send'
    ),
    'options' => array(
      'label' => ' '
    ),
  ));
 }



}

