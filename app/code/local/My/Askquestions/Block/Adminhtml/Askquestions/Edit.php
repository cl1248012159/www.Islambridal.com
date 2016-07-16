<?php
	
class My_Askquestions_Block_Adminhtml_Askquestions_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "id";
				$this->_blockGroup = "askquestions";
				$this->_controller = "adminhtml_askquestions";
				$this->_updateButton("save", "label", Mage::helper("askquestions")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("askquestions")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("askquestions")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("askquestions_data") && Mage::registry("askquestions_data")->getId() ){

				    return Mage::helper("askquestions")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("askquestions_data")->getId()));

				} 
				else{

				     return Mage::helper("askquestions")->__("Add Item");

				}
		}
}