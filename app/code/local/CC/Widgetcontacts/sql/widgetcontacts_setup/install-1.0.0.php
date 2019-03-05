<?php

/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();

$installer->run("
    CREATE TABLE IF NOT EXISTS `{$this->getTable('widgetcontacts/block')}` (
        `contact_id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(100) NULL,
        `country` varchar(100) NULL,
        `city` varchar(100) NULL,
        `street` varchar(100) NULL,
        `build` varchar(100) NULL,
        `phone` varchar(50) NULL,
        `created_at` datetime NOT NULL,
        PRIMARY KEY (`contact_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
");

$installer->endSetup();
