<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
CREATE TABLE IF NOT EXISTS `askquestions` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `type` int(4) NOT NULL COMMENT '1是product descript 2是shipping or payment,3processing time ,4others',
  `title` varchar(255) CHARACTER SET latin1 NOT NULL COMMENT '问题title',
  `content` varchar(255) CHARACTER SET latin1 NOT NULL COMMENT '问题内容',
  `customer_id` bigint(11) DEFAULT NULL,
  `product_id` int(4) NOT NULL,
  `store_id` int(4) NOT NULL,
  `reply` varchar(255) CHARACTER SET latin1 DEFAULT NULL COMMENT '管理员回复',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
		
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 