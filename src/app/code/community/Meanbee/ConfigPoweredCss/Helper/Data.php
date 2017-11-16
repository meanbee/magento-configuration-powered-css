<?php

class Meanbee_ConfigPoweredCss_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * Attempts to publish the config powered css for all stores
     * Used in both the controller and the shell class.
     */
    public function regenerateConfigPoweredCss()
    {
        /** @var Meanbee_ConfigPoweredCss_Model_Css $css */
        $css = Mage::getModel('meanbee_configpoweredcss/css');

        $stores = Mage::app()->getStores();

        foreach ($stores as $storeId => $store) {
            Mage::app()->setCurrentStore($storeId);
            $css->publish($storeId);
        }
    }

}