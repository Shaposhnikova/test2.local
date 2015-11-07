<?php

$installer = $this;
/** @var $installer Mage_Catalog_Model_Resource_Setup */

$installer->startSetup();
/**
 * Add attributes to the eav/attribute
 */
$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'video', array(
    'group'         => 'General',
    'input'         => 'text',
    'type'          => 'text',
    'label'         => 'Video',
    'backend'       => '',
    'visible'       => true,
    'required'      => false,
    'visible_on_front' => true,
));

$installer->endSetup();