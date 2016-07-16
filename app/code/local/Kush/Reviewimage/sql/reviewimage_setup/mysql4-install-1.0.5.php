<?php
$installer = $this;
$installer->startSetup();
$tablename = $this->getTable('review/review_detail');
$installer->run("ALTER TABLE `$tablename` ALTER column `reviewimage1` VARCHAR( 255 ) DEFAULT NULL;");
$installer->run("ALTER TABLE `$tablename` ALTER column `reviewimage2` VARCHAR( 255 ) DEFAULT NULL;");
$installer->run("ALTER TABLE `$tablename` ALTER column `reviewimage3` VARCHAR( 255 ) DEFAULT NULL;");
$installer->run("ALTER TABLE `$tablename` ALTER column `reviewimage4` VARCHAR( 255 ) DEFAULT NULL;");
$installer->run("ALTER TABLE `$tablename` ALTER column `reviewimage5` VARCHAR( 255 ) DEFAULT NULL;");
$installer->endSetup(); 


?>