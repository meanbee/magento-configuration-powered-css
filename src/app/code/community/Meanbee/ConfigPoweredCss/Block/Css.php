<?php

class Meanbee_ConfigPoweredCss_Block_Css extends Mage_Core_Block_Template
{

    public function __construct() {
        parent::__construct();

        $this->setTemplate('meanbee/configpoweredcss/css.phtml');
    }

    /**
     * Get store config
     * @param $path
     * @param null $store
     * @return mixed
     */
    public function getConfig($path, $store = null)
    {
        return Mage::getStoreConfig($path, $store);
    }
}