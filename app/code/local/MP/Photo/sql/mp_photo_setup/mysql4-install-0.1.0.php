<?php



$installer = $this;
$installer->startSetup();

$setup = new Mage_Customer_Model_Entity_Setup('core_setup');

$entityTypeId     = $setup->getEntityTypeId('customer');
$attributeSetId   = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$setup->addAttribute('customer', 'customer_photo', array(
    'input'         => 'text', //or select or whatever you like
    'type'          => 'int', //or varchar or anything you want it
    'label'         => 'customer_photo',
    'visible'       => 1,
    'required'      => 0, //mandatory? then 1
    'user_defined' => 1,
));

$setup->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'customer_photo',
    '100'
);

$oAttribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'customer_photo');
$oAttribute->setData('used_in_forms', array('adminhtml_customer'));
$oAttribute->save();

$setup->endSetup();

