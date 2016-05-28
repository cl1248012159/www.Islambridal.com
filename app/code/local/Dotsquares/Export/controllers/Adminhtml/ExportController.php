<?php

class Dotsquares_Export_Adminhtml_ExportController extends Mage_Adminhtml_Controller_Action
{

	public function indexAction() {
		$this->_title(Mage::helper('dotsquares_export')->__('Export Profiles'));

		$this->loadLayout()->_setActiveMenu('dotsquares_core/export');
		$this->renderLayout();
	}

	public function categoryAction() {
		$type = $this->getRequest()->getParam('type');
		$this->_title(Mage::helper('dotsquares_export')->__('Export Category Profiles'));
		$this->getResponse()->setBody($this->getLayout()->createBlock('dotsquares_export/adminhtml_category_export_'.$type)->toHtml());
		$this->getResponse()->sendResponse();
	}

}