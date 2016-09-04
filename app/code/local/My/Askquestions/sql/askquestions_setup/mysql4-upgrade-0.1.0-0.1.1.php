<?php


$installer = $this;
$connection = $installer->getConnection();
$installer->startSetup();

$installer->run("
        ALTER TABLE `{$installer->getTable('askquestions')}`
        ADD `reply_at` datetime NULL
    ");

$installer->endSetup();