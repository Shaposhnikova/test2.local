<?php
/**
 * Magento
 *
 * Override Mage_Checkout_Cart controller
 */


/**
 * IMPORTANT
 * Include the core file to be overridden
 */
require_once("Mage/Catalog/controllers/CategoryController.php");

/**
 * IMPORTANT
 * Extend the core controller in our custom controller.
 */
class Logg_Access_CategoryController extends Mage_Catalog_CategoryController
{
    /**
     * Get current active quote instance
     *
     * @return Mage_Sales_Model_Quote
     */
    public function viewAction()
    {
        if ($category = $this->_initCatagory()) {
            $design = Mage::getSingleton('catalog/design');
            $settings = $design->getDesignSettings($category);
            $category->getAttributes();
            if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
                $isLoggedIn = 0;
                foreach ($category->getData() as $key => $attribute) {
                    if ($key == 'only_logged_in') {
                        $isLoggedIn = $attribute;
                    }
                }
                if ($isLoggedIn == 1) {
                    Mage::app()->getResponse()->setRedirect(Mage::getUrl("customer/account/login"));
                }
            }

        }
    }
}