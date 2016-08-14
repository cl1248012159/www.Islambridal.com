<?php
$installer = $this;
$installer->startSetup();
$installer->run("
ALTER TABLE `{$installer->getTable('core_url_rewrite')}` DROP INDEX `UNQ_CORE_URL_REWRITE_REQUEST_PATH_STORE_ID`;
");
$installer->endSetup();
