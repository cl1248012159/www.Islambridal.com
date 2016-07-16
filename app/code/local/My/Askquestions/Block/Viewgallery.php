<?php
class My_Askquestions_Block_Viewgallery extends Mage_Core_Block_Template
{

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

        $toolbar = $this->getLayout()->createBlock('page/html_pager', 'customer_review_list.toolbar')
            ->setLimit(36)
            ->setCollection($this->getReviewsCollection());

        $this->setChild('toolbar', $toolbar);

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
