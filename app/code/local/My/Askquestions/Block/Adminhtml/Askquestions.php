<?php


class My_Askquestions_Block_Adminhtml_Askquestions extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_askquestions";
	$this->_blockGroup = "askquestions";
	$this->_headerText = Mage::helper("askquestions")->__("Askquestions Manager");
	$this->_addButtonLabel = Mage::helper("askquestions")->__("Add New Item");
	parent::__construct();
	
	}

}