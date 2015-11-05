<?php

// методы взяты из класса Mage_Eav_Model_Entity_Setup в файле D:\apache\_ROOT_\ZEND\mage\empty\app\code\core\Mage\Eav\Model\Entity\Setup.php)

$installer = $this;
$installer->startSetup();

$entityTypeId     = $installer->getEntityTypeId('catalog_category');
$attributeSetId   = $installer->getDefaultAttributeSetId($entityTypeId);
//$attributeGroupId = $installer->getDefaultAttributeGroupId($entityTypeId, $attributeSetId); //можно получить дефолтную группу
$attributeGroupId = $installer->getAttributeGroupId($entityTypeId, $attributeSetId, 'General Information'); //получить группу по названию или ID

$installer->addAttribute('catalog_category', 'unique_id',  array(
    'type'     => 'text',
    'label'    => 'Unique ID',
    'input'    => 'text',
    'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true,
    'required'          => false,
    'user_defined'      => true,
    'default'           => 0
));


$installer->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'unique_id',
    '11'                    //позиция атрибута в закладке. В закладке General всего 10 элементов
);

$attributeId = $installer->getAttributeId($entityTypeId, 'unique_id');

//тут надо обратить внимание на тип атрибута, от этого зависит какую таблицу значений используем (в нашем случае catalog_category_entity_text)

$installer->run("
INSERT INTO `{$installer->getTable('catalog_category_entity_text')}`
(`entity_type_id`, `attribute_id`, `entity_id`, `value`)
    SELECT '{$entityTypeId}', '{$attributeId}', `entity_id`, '1'
        FROM `{$installer->getTable('catalog_category_entity')}`;
");

//данная запись установить ваш атрибут для рутовой категории
Mage::getModel('catalog/category')
    ->load(1)
    ->setImportedCatId(0)
    ->setInitialSetupFlag(true)
    ->save();

//данная запись пропишет ваш атрибут в дефолтной категории
Mage::getModel('catalog/category')
    ->load(2)
    ->setImportedCatId(0)
    ->setInitialSetupFlag(true)
    ->save();

$installer->endSetup();


