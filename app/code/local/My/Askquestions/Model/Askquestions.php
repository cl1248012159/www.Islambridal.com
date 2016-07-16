<?php

class My_Askquestions_Model_Askquestions extends Mage_Core_Model_Abstract
{
    protected function _construct(){

       $this->_init("askquestions/askquestions");

    }

	/* 
	* update questions data 
	* $param  $data array
	* return $this
	*/
	public function updataQuestionsData($data){
		try{
			if(!empty($data)){
				$this->setName($data['askquestionname']);
				$this->setEmail($data['askquestionemail']);
				$this->setType($data['askquestiontype'][0]);
				$this->setTitle($data['askquestiontitle']);
				$this->setContent($data['askquestioncontent']);
				if($data['customerid']){
					$this->setCustomerId($data['customerid']);
				}
				$this->setSku($data['sku']);
				$this->setProductId($data['productid']);
				$this->setStoreId($data['storeid']);
				$this->setstatus(false);
				$time=now();
				$this->setCreatedAt($time);
			}else{
				throw new Exception("Error Processing Request:Insufficient Data Provided");
			}
		}catch(Exception $e){
			Mage::logException($e);
		}
		return $this;
	}
}
	 