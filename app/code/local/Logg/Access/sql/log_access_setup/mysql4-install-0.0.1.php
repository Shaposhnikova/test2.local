<?php

$installer = $this;
$installer->startSetup();
$attribute  = array(
    'type' => 'text',
    'label'=> 'only_logged_in',
    'source' => 'eav/entity_attribute_source_boolean',
    'input' => 'select',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => false,
    'user_defined' => true,
    'default' => "",
    'group' => "General Information"
);
$installer->addAttribute('catalog_category', 'only_logged_in', $attribute);
$installer->endSetup();