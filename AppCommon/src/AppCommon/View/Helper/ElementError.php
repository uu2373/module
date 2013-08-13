<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: FormErrors.php 20096 2010-01-06 02:05:09Z bkarwin $
 */

/**
 * Abstract class for extension
 */
//require_once 'Zend/View/Helper/FormElement.php';


/**
 * Helper to render errors for a form element
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
//class Zend_View_Helper_FormErrors extends Zend_View_Helper_FormElement
class Zend_View_Helper_ElementError extends Zend_View_Helper_Abstract     
{
	/**
	 * @var Zend_Form_Element
	 */
	protected $_element;

	/**#@+
	 * @var string Element block start/end tags and separator
	 */
	protected $_htmlElementEnd       = '</div></div>';
	//protected $_htmlElementStart     = '<ul%s><li>';
	protected $_htmlElementStart     = '<div%s></div>';
	protected $_htmlElementSeparator = '</div><div>';
	
	
	
	
	/**#@-*/

	/**
	 * Render form errors
	 *
	 * @param  string|array $errors Error(s) to render
	 * @param  array $options
	 * @return string
	 */
	public function elementError($errors, array $options = null)
	{
		$content='';
		$escape = true;
		if (isset($options['escape'])) {
			$escape = (bool) $options['escape'];
			unset($options['escape']);
		}

		if (empty($options['class'])) {
			$options['class'] = 'errors';
		}
		if (!$errors) return ''; 	
///////////////////////////////		
		$view    = $errors->getView();
		if (null === $view) {
			return $content;
		}

		$_errorsmsg = $errors->getMessages();
		if (empty($_errorsmsg)) {
			return '';
		}
		return current($_errorsmsg);
	}


}
