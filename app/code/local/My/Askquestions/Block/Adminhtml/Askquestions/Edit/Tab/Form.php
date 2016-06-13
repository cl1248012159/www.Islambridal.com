<?php
class My_Askquestions_Block_Adminhtml_Askquestions_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("askquestions_form", array("legend"=>Mage::helper("askquestions")->__("Item information")));

				

				if (Mage::getSingleton("adminhtml/session")->getAskquestionsData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getAskquestionsData());
					Mage::getSingleton("adminhtml/session")->setAskquestionsData(null);
				} 
				elseif(Mage::registry("askquestions_data")) {
				    $form->setValues(Mage::registry("askquestions_data")->getData());
				}
				return parent::_prepareForm();
		}
}
