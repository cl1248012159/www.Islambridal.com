<?php

/**
 * Import category block
 *
 * @category   Dotsquares
 * @package    Dotsquares_Import
 * @author     Dotsquares <madhu.rajawat@dotsquares.com>
 */
class Dotsquares_Import_Block_Adminhtml_Category_Import extends Dotsquares_Import_Block_Adminhtml_Import
{

	public function getTitle($type) {
		$types = array(
			'categories' => $this->__('Import Categories'),
			'attributes' => $this->__('Import Category Attributes')
		);
		if (isset($types[$type])) return $types[$type];
		return '';
	}

	public function getFilePath() {
		
	
	$uploaddir = 'var' . DS . 'import' . DS;
	
		if(!file_exists($uploaddir))
		{
			@mkdir( $uploaddir );			
		}
	
		return 'var' . DS . 'import' . DS . 'category';
	
	}

	public function getFileName($type) {
		$types = array(
			'categories' => 'categories.csv',
			'attributes' => 'attributes.csv'
		);
		if (isset($types[$type])) return $types[$type];
		return '';
	}

	public function showExportInfo($type) {
		return $this->getLayout()->createBlock('dotsquares_import/adminhtml_category_import')
				->setTemplate('import/category/'.$type.'.phtml')
				->toHtml();
	}

	public function getAttributes() {
		return $this->helper('dotsquares_core/category')->getAttributes();
	}

}
