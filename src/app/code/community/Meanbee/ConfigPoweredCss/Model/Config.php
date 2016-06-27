<?php

class Meanbee_ConfigPoweredCss_Model_Config
{
    const XML_PATH_ENABLED = 'dev/meanbee_configpoweredcss/enabled';
    const XML_PATH_HEAD_BLOCK = 'dev/meanbee_configpoweredcss/head_block';
    const XML_PATH_LOGGING = 'dev/meanbee_configpoweredcss/logging';
    const LOG_FILENAME = 'meanbee_configpoweredcss.log';
    const CSS_FILENAME = 'meanbee_configpoweredcss_%d.css';
    const CSS_PATH = 'css/config/%s/%s/';

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

    /**
     * Get full filepath to CSS file
     *
     * @param $store
     * @return string
     */
    public function getFullCssFilePath($store = null)
    {
        return $this->getCssDirectoryPath() . $this->getCssFilename($store);
    }

    /**
     * Get directory for CSS files
     *
     * @param $store
     * @return string
     */
    public function getCssDirectoryPath($store = null)
    {

        return Mage::getBaseDir('media') . DS . $this->getCssPath($store);
    }

    /**
     * Retrieve the CSS path relative to the media directory
     * @param null $store
     * @return string
     */
    public function getCssPath($store = null)
    {
        return sprintf(self::CSS_PATH, $this->_getDesignPackage($store), $this->_getDesignTheme($store));
    }

    /**
     * Generate the URL to access the stylesheet for the store.
     *
     * @param null $store
     * @return string
     */
    public function getCssFileUrl($store = null)
    {
        $url_parts = array(
            Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA),
            $this->getCssPath($store),
            $this->getCssFilename($store)
        );

        array_walk($url_parts, function (&$item) {
            $item = trim($item, '/');
        });

        $url = join('/', $url_parts);

        return $this->stripProtocolFromUrl($url);
    }

    /**
     * Get the current package for store
     * @param int|null $store
     * @return mixed
     */
    protected function _getDesignPackage($store = null)
    {
        return Mage::getStoreConfig('design/package/name', $store);
    }

    /**
     * Get the current theme for the store
     * @param int|null $store
     * @return string
     */
    protected function _getDesignTheme($store = null)
    {
        $theme = Mage::getStoreConfig('design/theme/template', $store);
        if (!$theme) {
            $theme = Mage::getStoreConfig('design/theme/default', $store);
        }
        if (!$theme) {
            $theme = 'default';
        }

        return $theme;
    }

    /**
     * Given a URL, remove the protocol.  For example, "https://test.com/jpeg" becomes "//test.com/jpeg".
     *
     * @param string $url
     * @return string
     */
    protected function stripProtocolFromUrl($url)
    {
        return preg_replace('/^https?:/', '', $url);
    }
}
