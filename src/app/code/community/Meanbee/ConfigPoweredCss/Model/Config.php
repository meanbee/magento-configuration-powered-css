<?php

class Meanbee_ConfigPoweredCss_Model_Config
{
    const XML_PATH_ENABLED = 'dev/meanbee_configpoweredcss/enabled';
    const XML_PATH_HEAD_BLOCK = 'dev/meanbee_configpoweredcss/head_block';
    const XML_PATH_LOGGING = 'dev/meanbee_configpoweredcss/logging';
    const LOG_FILENAME = 'meanbee_configpoweredcss.log';
    const CSS_FILENAME = 'css/meanbee_configpoweredcss_%d.css';

    /**
     * Is the extension enabled?
     *
     * @param null $store
     * @return bool
     */
    public function isEnabled($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED, $store);
    }

    /**
     * Is Logging Enabled?
     *
     * @param null $store
     * @return bool
     */
    public function isLoggingEnabled($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_LOGGING, $store);
    }

    /**
     * Get Head block reference
     *
     * @param null $store
     * @return string
     */
    public function getHeadBlockReference($store = null)
    {
        $headBlock = Mage::getStoreConfig(self::XML_PATH_HEAD_BLOCK, $store);

        // Default to core 'head' page/html_head block name if empty
        if (!$headBlock) {
            $headBlock = 'head';
        }

        return $headBlock;
    }

    /**
     * Filename to write logs to
     *
     * @return string
     */
    public function getLogFilename()
    {
        return self::LOG_FILENAME;
    }

    /**
     * Get CSS filename
     * @param null $store
     * @return string
     */
    public function getCssFilename($store = null)
    {
        $store = $store ? $store : Mage::app()->getStore()->getStoreId();
        return sprintf(self::CSS_FILENAME, $store);
    }
}
