<?php

class My_Askquestions_Block_Adminhtml_Askquestions_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("askquestionsGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("askquestions/askquestions")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("askquestions")->__("ID"),
				"align" =>"right",
				"width" => "20px",
			    "type" => "number",
				"index" => "id",
				));
				
				$this->addColumn("name", array(
				"header" => Mage::helper("askquestions")->__("Name"),
				"align" =>"right",
				"width" => "30px",
			    "type" => "varcher",
				"index" => "name",
				));
				$this->addColumn("email", array(
				"header" => Mage::helper("askquestions")->__("Email"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "varcher",
				"index" => "email",
				));
				$this->addColumn("type", array(
				"header" => Mage::helper("askquestions")->__("Type"),
				"align" =>"right",
				"width" => "20px",
			    "type" => "number",
				"index" => "type",
				));
				$this->addColumn("title", array(
				"header" => Mage::helper("askquestions")->__("Title"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "varcher",
				"index" => "title",
				));
				
				$this->addColumn("content", array(
				"header" => Mage::helper("askquestions")->__("Content"),
				"align" =>"right",
				"width" => "150px",
			    "type" => "varcher",
				"index" => "content",
				));
				$this->addColumn("customer_id", array(
				"header" => Mage::helper("askquestions")->__("Customer Id"),
				"align" =>"right",
				"width" => "20px",
			    "type" => "number",
				"index" => "customer_id",
				));
				$this->addColumn("sku", array(
				"header" => Mage::helper("askquestions")->__("Sku"),
				"align" =>"right",
				"width" => "20px",
			    "type" => "varcher",
				"index" => "sku",
				));
				$this->addColumn("product_id", array(
				"header" => Mage::helper("askquestions")->__("Product Id"),
				"align" =>"right",
				"width" => "20px",
			    "type" => "number",
				"index" => "product_id",
				));
				$this->addColumn("reply", array(
				"header" => Mage::helper("askquestions")->__("Reply"),
				"align" =>"right",
				"width" => "150px",
			    "type" => "varcher",
				"index" => "reply",
				));
				$this->addColumn('status', array(
					'header'    => Mage::helper('askquestions')->__('Status'),
					'index'     => 'status',
					'width'     => '50',
					'type' => 'options',
					'options' => array('0'=>'Disable','1'=>'Enable')
				));
                $this->addColumn("created_at", array(
				"header" => Mage::helper("askquestions")->__("Created At"),
				"align" =>"right",
				"width" => "150px",
			    "type" => "varcher",
				"index" => "created_at",
				));
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('id');
			$this->getMassactionBlock()->setFormFieldName('ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_askquestions', array(
					 'label'=> Mage::helper('askquestions')->__('Remove Askquestions'),
					 'url'  => $this->getUrl('*/adminhtml_askquestions/massRemove'),
					 'confirm' => Mage::helper('askquestions')->__('Are you sure?')
				));
			return $this;
		}
			

}