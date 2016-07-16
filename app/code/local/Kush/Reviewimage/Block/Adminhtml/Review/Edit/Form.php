<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2013 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml Review Edit Form
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class Kush_Reviewimage_Block_Adminhtml_Review_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        
        $review = Mage::registry('review_data');
        $product = Mage::getModel('catalog/product')->load($review->getEntityPkValue());
        $customer = Mage::getModel('customer/customer')->load($review->getCustomerId());

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'), 'ret' => Mage::registry('ret'))),
            'method'    => 'post'
        ));

        
        $fieldset = $form->addFieldset('review_details', array('legend' => Mage::helper('review')->__('Review Details'), 'class' => 'fieldset-wide'));

        
        $fieldset->addField('product_name', 'note', array(
            'label'     => Mage::helper('review')->__('Product'),
            'text'      => '<a href="' . $this->getUrl('*/catalog_product/edit', array('id' => $product->getId())) . '" onclick="this.target=\'blank\'">' . $product->getName() . '</a>'
        ));

        if ($customer->getId()) {
            $customerText = Mage::helper('review')->__('<a href="%1$s" onclick="this.target=\'blank\'">%2$s %3$s</a> <a href="mailto:%4$s">(%4$s)</a>', $this->getUrl('*/customer/edit', array('id' => $customer->getId(), 'active_tab'=>'review')), $this->escapeHtml($customer->getFirstname()), $this->escapeHtml($customer->getLastname()), $this->escapeHtml($customer->getEmail()));
        } else {
            if (is_null($review->getCustomerId())) {
                $customerText = Mage::helper('review')->__('Guest');
            } elseif ($review->getCustomerId() == 0) {
                $customerText = Mage::helper('review')->__('Administrator');
            }
        }

        
        
        $fieldset->addField('customer', 'note', array(
            'label'     => Mage::helper('review')->__('Posted By'),
            'text'      => $customerText,
        ));
        
        /* 
         * added new image custom field 
         * 
         */
       if(Mage::helper("reviewimage")->getActive() == '1'):
           if($review->getReviewimage1()){
               $imageUrl = Mage::getBaseUrl("media").'reviewimages/'.$review->getReviewimage1();
               $image= "<image src='".$imageUrl."' style='max-width:200px;max-height:200px;'>";
               $fieldset->addField('reviewimage1', 'note', array(
                   'label'     => Mage::helper('review')->__('Posted Review Image'),
                   'text'      => $image,
               ));
           }
           if($review->getReviewimage2()){
               $imageUrl = Mage::getBaseUrl("media").'reviewimages/'.$review->getReviewimage2();
               $image= "<image src='".$imageUrl."' style='max-width:200px;max-height:200px;'>";
               $fieldset->addField('reviewimage1', 'note', array(
                   'label'     => Mage::helper('review')->__('Posted Review Image'),
                   'text'      => $image,
               ));
           }
           if($review->getReviewimage3()){
               $imageUrl = Mage::getBaseUrl("media").'reviewimages/'.$review->getReviewimage3();
               $image= "<image src='".$imageUrl."' style='max-width:200px;max-height:200px;'>";
               $fieldset->addField('reviewimage1', 'note', array(
                   'label'     => Mage::helper('review')->__('Posted Review Image'),
                   'text'      => $image,
               ));
           }
           if($review->getReviewimage4()){
               $imageUrl = Mage::getBaseUrl("media").'reviewimages/'.$review->getReviewimage4();
               $image= "<image src='".$imageUrl."' style='max-width:200px;max-height:200px;'>";
               $fieldset->addField('reviewimage1', 'note', array(
                   'label'     => Mage::helper('review')->__('Posted Review Image'),
                   'text'      => $image,
               ));
           }
           if($review->getReviewimage5()){
               $imageUrl = Mage::getBaseUrl("media").'reviewimages/'.$review->getReviewimage5();
               $image= "<image src='".$imageUrl."' style='max-width:200px;max-height:200px;'>";
               $fieldset->addField('reviewimage1', 'note', array(
                   'label'     => Mage::helper('review')->__('Posted Review Image'),
                   'text'      => $image,
               ));
           }
       endif;

        /*
         * added new image custom field 
         * 
         */
         
        $fieldset->addField('summary_rating', 'note', array(
            'label'     => Mage::helper('review')->__('Summary Rating'),
            'text'      => $this->getLayout()->createBlock('adminhtml/review_rating_summary')->toHtml(),
        ));

        $fieldset->addField('detailed_rating', 'note', array(
            'label'     => Mage::helper('review')->__('Detailed Rating'),
            'required'  => true,
            'text'      => '<div id="rating_detail">'
                           . $this->getLayout()->createBlock('adminhtml/review_rating_detailed')->toHtml()
                           . '</div>',
        ));
                
     
        $fieldset->addField('status_id', 'select', array(
            'label'     => Mage::helper('review')->__('Status'),
            'required'  => true,
            'name'      => 'status_id',
            'values'    => Mage::helper('review')->getReviewStatusesOptionArray(),
        ));
  
        /**
         * Check is single store mode
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $field = $fieldset->addField('select_stores', 'multiselect', array(
                'label'     => Mage::helper('review')->__('Visible In'),
                'required'  => true,
                'name'      => 'stores[]',
                'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(),
            ));
            $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
            $field->setRenderer($renderer);
            $review->setSelectStores($review->getStores());
        }
        else {
            $fieldset->addField('select_stores', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
            $review->setSelectStores(Mage::app()->getStore(true)->getId());
        }

        $fieldset->addField('nickname', 'text', array(
            'label'     => Mage::helper('review')->__('Nickname'),
            'required'  => true,
            'name'      => 'nickname'
        ));

        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('review')->__('Summary of Review'),
            'required'  => true,
            'name'      => 'title',
        ));

        $dateFormatIso = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        $fieldset->addField('created_at', 'date', array(
            'name'   => 'created_at',
            'label'  => Mage::helper('salesrule')->__('创建时间'),
            'title'  => Mage::helper('salesrule')->__('创建时间'),
            'image'  => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
            'format'       => $dateFormatIso
        ));

        $fieldset->addField('detail', 'textarea', array(
            'label'     => Mage::helper('review')->__('Review'),
            'required'  => true,
            'name'      => 'detail',
            'style'     => 'height:24em;',
        ));

        $form->setUseContainer(true);
        $form->setValues($review->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
