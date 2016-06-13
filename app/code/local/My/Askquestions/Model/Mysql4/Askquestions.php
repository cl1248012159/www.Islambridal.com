<?php
class My_Askquestions_Model_Mysql4_Askquestions extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("askquestions/askquestions", "id");
    }
}