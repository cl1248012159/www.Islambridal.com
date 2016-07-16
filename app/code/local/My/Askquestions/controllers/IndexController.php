<?php
class My_Askquestions_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Titlename"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("titlename", array(
                "label" => $this->__("Titlename"),
                "title" => $this->__("Titlename")
		   ));

      $this->renderLayout(); 
	  
    }
	
	public function addAction(){
		$data = $this->getRequest()->getPost();
		$product = Mage::getModel('catalog/product')->load($data['productid']);
		$url = $product->getProductUrl();
		try{
			$question = Mage::getModel('askquestions/askquestions');
			$question->updataQuestionsData($data);
			$question->save();
			$successMessage=Mage::helper('askquestions')->__('Add Questions Successfully');
			Mage::getSingleton('core/session')->addSuccess($successMessage);
		}catch(Mage_Core_Exception $e){
			Mage::getSingleton('core/session')->addError($e->getMessage());
			$this->_redirectUrl($url);
		}
		$this->_redirectUrl($url);
		
	}
}