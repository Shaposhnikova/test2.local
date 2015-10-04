<?php

class CC_CatalogCustomization_Model_Price_Observer
{
    /**
     * Applies the special price percentage discount
     * @param   Varien_Event_Observer $observer
     * @return  CC_Catalog_Model_Price_Observer
     */
    public function applyDiscountPercent($observer)
    {
        $event = $observer->getEvent();
        $product = $event->getProduct();
        // process percentage discounts only for simple products
        if ($product->getSuperProduct() && $product->getSuperProduct()->isConfigurable()) {
        } else {
            $percentDiscount = 30;//$product->getPercentDiscount();

            if (is_numeric($percentDiscount)) {
                $today = floor(time() / 86400) * 86400;
                $from = floor(strtotime($product->getSpecialFromDate()) / 86400) * 86400;
                $to = floor(strtotime($product->getSpecialToDate()) / 86400) * 86400;

                if ($product->getSpecialFromDate() && $today < $from) {
                } elseif ($product->getSpecialToDate() && $today > $to) {
                } else {
                    $price = $product->getPrice();
                    $finalPriceNow = $product->getData('final_price');

                    $specialPrice = $price + $price * $percentDiscount / 100;

                    // if special price is negative - negate the discount - this may be a mistake in data
                    if ($specialPrice < 0)
                        $specialPrice = $finalPriceNow;

                    // if ($specialPrice < $finalPriceNow)
                    $product->setFinalPrice($specialPrice); // set the product final price
                }
            }
        }

        return $this;
    }
}


//catalog_product_collection_load_after







