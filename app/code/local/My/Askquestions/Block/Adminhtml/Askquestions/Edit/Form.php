<?php
class My_Askquestions_Block_Adminhtml_Askquestions_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{
				$form = new Varien_Data_Form(array(
				"id" => "edit_form",
				"action" => $this->getUrl("*/*/save", array("id" => $this->getRequest()->getParam("id"))),
				"method" => "post",
				"enctype" =>"multipart/form-data",
				)
				);
				$form->setUseContainer(true);
				$id = $this->getRequest()->getParam('id');
				$model = Mage::getModel("askquestions/askquestions")->load($id);
				$fieldset = $form->addFieldset('questions_form', array('legend'=>Mage::helper('askquestions')->__('Questions information')));
				$fieldset->addField('title','text',array(
					'name'      => 'title',
					'label'     => Mage::helper('askquestions')->__('Title'),
					'title'     => Mage::helper('askquestions')->__('Title'),
					'required'  => true,
					'value'     => $model->getTitle(),
				));
				$fieldset->addField('content','textarea',array(
					'name'      => 'content',
					'label'     => Mage::helper('askquestions')->__('Content'),
					'title'     => Mage::helper('askquestions')->__('Content'),
					'required'  => true,
					'value'     => $model->getContent(),
				));
				$fieldset->addField('status', 'select', array(
					'name'      => 'status',
					'label'     => Mage::helper('askquestions')->__('Status'),
					'title'     => Mage::helper('askquestions')->__('Status'),
					'required'  => true,
					'value'     => $model->getStatus(),
					'values'    => array('1'=>Mage::helper('askquestions')->__('Enable'),'0'=>Mage::helper('askquestions')->__('Disable')),
				));
            $dateFormatIso = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
            $fieldset->addField('created_at', 'date', array(
                'name'   => 'created_at',
                'label'  => Mage::helper('askquestions')->__('创建时间'),
                'title'  => Mage::helper('askquestions')->__('创建时间'),
                'image'  => $this->getSkinUrl('images/grid-cal.gif'),
                'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
                'format'       => $dateFormatIso
            ));
				$fieldset->addField('reply','textarea',array(
					'name'      => 'reply',
					'label'     => Mage::helper('askquestions')->__('Reply'),
					'title'     => Mage::helper('askquestions')->__('Reply'),
					'required'  => false,
					'value'     => $model->getReply(),
				));
            $fieldset->addField('reply_at', 'date', array(
                'name'   => 'reply_at',
                'label'  => Mage::helper('askquestions')->__('管理员回复时间'),
                'title'  => Mage::helper('askquestions')->__('管理员回复时间'),
                'image'  => $this->getSkinUrl('images/grid-cal.gif'),
                'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
                'format'       => $dateFormatIso
            ));
				$this->setForm($form);
				return parent::_prepareForm();
		}
}
