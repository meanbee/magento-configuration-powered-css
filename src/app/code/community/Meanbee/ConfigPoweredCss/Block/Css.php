<?php

class Meanbee_ConfigPoweredCss_Block_Css extends Mage_Core_Block_Template
{

    public function __construct()
    {
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

    /**
     * Get High DPI media query string
     *
     * @param float $ratio
     * @return string
     */
    public function hidpi($ratio = 1.3)
    {
        $dpi = round($ratio * 96);
        return <<<END
@media only screen and (-webkit-min-device-pixel-ratio: $ratio),
only screen and (min--moz-device-pixel-ratio: $ratio),
only screen and (-o-min-device-pixel-ratio: $ratio/1),
only screen and (min-resolution: {$dpi}dpi),
only screen and (min-resolution: {$ratio}dppx)
END;

    }
}