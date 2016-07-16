<?php
class My_Askquestions_Block_Askquestions extends Mage_Core_Block_Template
{
	public function _prepareLayout()
	{
		return parent::_prepareLayout();	
	}
	
	/* 
	* get all type questions
	* int $type 
	* return  $collection
	*/
	 public function getQuestions($type) 
	{
		$collection=null;
		$product_id = Mage::registry('current_product')->getId();
		$storeid = Mage::app()->getStore()->getStoreId();
		if($product_id){
			if(!$type){
				$collection=Mage::getModel('askquestions/askquestions')->getCollection()
						->addFieldToFilter('product_id',$product_id)
						->addFieldToFilter('store_id',$storeid)
						->addFieldToFilter('status',1);
			}
			if($type == 1){
				$collection=Mage::getModel('askquestions/askquestions')->getCollection()
						->addFieldToFilter('product_id',$product_id)
						->addFieldToFilter('store_id',$storeid)
						->addFieldToFilter('type','1')
						->addFieldToFilter('status',1);
			}
			if($type == 2){
				$collection=Mage::getModel('askquestions/askquestions')->getCollection()
						->addFieldToFilter('product_id',$product_id)
						->addFieldToFilter('store_id',$storeid)
						->addFieldToFilter('type','2')
						->addFieldToFilter('status',1);
			}
			if($type == 3){
				$collection=Mage::getModel('askquestions/askquestions')->getCollection()
						->addFieldToFilter('product_id',$product_id)
						->addFieldToFilter('store_id',$storeid)
						->addFieldToFilter('type','3')
						->addFieldToFilter('status',1);
			}
			if($type ==4){
				$collection=Mage::getModel('askquestions/askquestions')->getCollection()
						->addFieldToFilter('product_id',$product_id)
						->addFieldToFilter('store_id',$storeid)
						->addFieldToFilter('type','4')
						->addFieldToFilter('status',1);
			}
			
		}
		return $collection;
	}
}