<?php
$this->startSetup();
$this->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'video', array(
    'group'         => 'General',
    'input'         => 'text',
    'type'          => 'text',
    'label'         => 'Video',
    'backend'       => '',
    'visible'       => true,
    'required'      => false,
    'visible_on_front' => true,
));
$this->endSetup();