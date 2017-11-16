<?php

class Meanbee_ConfigPoweredCss_Model_Css
{
    protected $config;

    /**
     * Meanbee_ConfigPoweredCss_Model_Css constructor.
     *
     * @param array $arguments
     * @param Meanbee_ConfigPoweredCss_Model_Config|null $config
     * @param Meanbee_ConfigPoweredCss_Model_LoggerInterface|null $logger
     */
    public function __construct($arguments, Meanbee_ConfigPoweredCss_Model_Config $config = null,
                                Meanbee_ConfigPoweredCss_Model_LoggerInterface $logger = null)
    {
        $this->config = is_null($config) ? Mage::getModel('meanbee_configpoweredcss/config') : $config;
        $this->logger = is_null($logger) ? Mage::getModel('meanbee_configpoweredcss/logger') : $logger;
    }

    /**
     * Generate CSS info and write out to file
     *
     * @param $storeId
     * @return bool
     */
    public function publish($storeId)
    {
        if (!$this->config->isEnabled($storeId)) {
            return false;
        }

        $package = Mage::getStoreConfig('design/package/name', $storeId);
        $theme = Mage::getStoreConfig('design/theme/template', $storeId);
        if (!$theme) {
            $theme = Mage::getStoreConfig('design/theme/default', $storeId);
        }
        if (!$theme) {
            $theme = 'default';
        }

        Mage::getDesign()->setArea('frontend')->setPackageName($package)->setTheme($theme);

        $block = Mage::app()->getLayout()->createBlock('meanbee_configpoweredcss/css');

        return $this->_writeToFile($block->toHtml(), $storeId);
    }

    /**
     * Write out to file
     *
     * @param $string
     * @param $storeId
     * @return bool
     * @throws Exception
     */
    protected function _writeToFile($string, $storeId)
    {
        if (!$storeId) {
            $this->logger->error('No store ID provided');
            return false;
        }

        $file = $this->config->getFullCssFilePath($storeId);
        $result = file_put_contents($file, $string, LOCK_EX);

        if ($result !== false) {
            return true;
        } else {
            $this->logger->error('There was an unknown error writing to ' . $file);
            throw new Exception("Unable to write to $file");
        }
    }
}
