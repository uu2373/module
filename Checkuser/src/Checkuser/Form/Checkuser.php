<?php
//Использование аннотаций (Annotations)
//http://zf2.com.ua/doc/161
namespace Checkuser\Form;

use Zend\Form\Annotation;
/**
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Name("Checkuser")
 */

class Checkuser{
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Логин абонента:"})
     */
    public $login;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Options({"label":"Статус абонента:"})
     * @Annotation\Attributes({"disabled":true})
     * @Annotation\AllowEmpty()
     */
    public $status;



    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Проверить"})
     * @Annotation\Attributes({"class":"btn"})
     */
    public $submit;




}

