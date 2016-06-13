<?php
class My_Askquestions_Block_Adminhtml_Askquestions_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("askquestions_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("askquestions")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("askquestions")->__("Item Information"),
				"title" => Mage::helper("askquestions")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("askquestions/adminhtml_askquestions_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
