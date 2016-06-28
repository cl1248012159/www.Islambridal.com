<?php
class My_Askquestions_Block_Uploadaphoto extends Mage_Core_Block_Template
{
    public function __construct()
    {
        $customerSession = Mage::getSingleton('customer/session');

        parent::__construct();

        $data =  Mage::getSingleton('review/session')->getFormData(true);
        $data = new Varien_Object($data);

        // add logged in customer name as nickname
        if (!$data->getNickname()) {
            $customer = $customerSession->getCustomer();
            if ($customer && $customer->getId()) {
                $data->setNickname($customer->getFirstname());
            }
        }

        $this->setAllowWriteReviewFlag(
            $customerSession->isLoggedIn() ||
            Mage::helper('review')->getIsGuestAllowToWrite()
        );

        if (!$this->getAllowWriteReviewFlag) {
            $this->setLoginLink(
                Mage::getUrl('customer/account/login/', array(
                    Mage_Customer_Helper_Data::REFERER_QUERY_PARAM_NAME => Mage::helper('core')->urlEncode(
                        Mage::getUrl('*/*/*', array('_current' => true)) .
                        '#review-form')
                    )
                )
            );
        }

        $this//->setTemplate('review/upload-a-photo.phtml')
            ->assign('data', $data)
            ->assign('messages', Mage::getSingleton('review/session')->getMessages(true));
    }

    public function getProductInfo()
    {
        $product = Mage::getModel('catalog/product');
        return $product->load($this->getRequest()->getParam('id'));
    }

    public function getAction()
    {
        $productku = Mage::app()->getRequest()->getParam('sku', false);
        $productId = Mage::getModel('catalog/product')->getIdBySku($productku);
        return Mage::getUrl('review/product/post', array('id' => $productId, '_secure' => $this->_isSecure()));
    }

    public function getRatings()
    {
        $ratingCollection = Mage::getModel('rating/rating')
            ->getResourceCollection()
            ->addEntityFilter('product')
            ->setPositionOrder()
            ->addRatingPerStoreName(Mage::app()->getStore()->getId())
            ->setStoreFilter(Mage::app()->getStore()->getId())
            ->load()
            ->addOptionToItems();
        return $ratingCollection;
    }


    protected $_reviewsCollection;

    public function getReviewsCollection()
    {
        if (null === $this->_reviewsCollection) {
            $this->_reviewsCollection = Mage::getModel('review/review')->getCollection()
                ->addStoreFilter(Mage::app()->getStore()->getId())
                ->addStatusFilter(Mage_Review_Model_Review::STATUS_APPROVED)
                ->addFieldToFilter(
                                        array(
                                            array('attribute'=>'detailc','eq'=>'reviewimage1'),
                                            array('attribute'=>'detailc','eq'=>'reviewimage2'),
                                            array('attribute'=>'detailc','eq'=>'reviewimage3'),
                                            array('attribute'=>'detailc','eq'=>'reviewimage4'),
                                            array('attribute'=>'detailc','eq'=>'reviewimage5'),
                                        ), 
                                        array( 
                                            array(  array('notnull' => true) ),
                                            array(  array('notnull' => true) ), 
                                            array(  array('notnull' => true) ), 
                                            array(  array('notnull' => true) ), 
                                            array(  array('notnull' => true) ), 
                                        )
                                    )
                ->setDateOrder();

        }
        return $this->_reviewsCollection;
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if ($toolbar = $this->getLayout()->getBlock('product_review_list.toolbar')) {
            $toolbar->setCollection($this->getReviewsCollection());
            $this->setChild('toolbar', $toolbar);
        }

        return $this;
    }
    protected function _beforeToHtml()
    {
        $this->getReviewsCollection()
            ->load()
            ->addRateVotes();
        return parent::_beforeToHtml();
    }


}
