<?php
$installer = $this;
$installer->startSetup();
$setup = new Mage_Customer_Model_Entity_Setup('core_setup');
$entityTypeId     = $setup->getEntityTypeId('customer');
$attributeSetId   = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);
$setup->addAttribute('customer', 'myphoto', array(
    'input'         => 'text', //or select or whatever you like
    'type'          => 'text', //or varchar or anything you want it
    'label'         => 'myphoto',
    'visible'       => 1,
    'required'      => 0, //mandatory? then 1
    'user_defined' => 1,
));
$setup->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'myphoto',
    '100'
);
$oAttribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'myphoto');
$oAttribute->setData('used_in_forms', array('adminhtml_customer'));
$oAttribute->save();
$setup->endSetup();
