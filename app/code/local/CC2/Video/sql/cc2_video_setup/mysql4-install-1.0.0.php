<?php

$installer = $this;
$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$entityTypeId     = $setup->getEntityTypeId('customer');
$attributeSetId   = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$setup->addAttribute('customer', 'video', array(
    'input'         => 'text',
    'type'          => 'text',
    'label'         => 'Video',
    'visible'       => True,
    'required'      => false,
    'user_defined' => true,
    'visible_on_front' => true,
));



$oAttribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'video');
$oAttribute->setData('used_in_forms', array('adminhtml_customer'));
$oAttribute->save();

$setup->endSetup();