<?php
/**
 * @category    Fishpig
 * @package     Fishpig_iBanners
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class Kush_Reviewimage_Block_Adminhtml_Review_Helper_Image extends Varien_Data_Form_Element_Image
{
    /**
     * Prepend the base image URL to the image filename
     *
     * @return null|string
     */
    protected function _getUrl()
    {
        $url = false;
        if ($this->getValue()) {
            $url = Mage::getBaseUrl('media').'reviewimages'. $this->getValue();
        }
        return $url;
    }
}