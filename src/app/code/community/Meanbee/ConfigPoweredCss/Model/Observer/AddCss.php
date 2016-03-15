<?php

class Meanbee_ConfigPoweredCss_Model_Observer_AddCss implements Meanbee_ConfigPoweredCss_Model_ObserverInterface
{
    /** @var Meanbee_ConfigPoweredCss_Model_LoggerInterface */
    protected $logger;

    /** @var Meanbee_ConfigPoweredCss_Model_Config */
    protected $config;

    /**
     * Meanbee_ConfigPoweredCss_Model_Observer_AddCss constructor.
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
     * @param Varien_Event_Observer $observer
     * @return void
     */
    public function observe(Varien_Event_Observer $observer)
    {
        if (!$this->config->isEnabled()) {
            return;
        }

        /** @var Mage_Core_Controller_Request_Http $request */
        $request = $observer->getAction()->getRequest();
        $module = $request->getModuleName();
        $action = $request->getActionName();
        $controller = $request->getControllerName();

        $this->logger->debug("Observing layout for {$module}_{$controller}_{$action}");

        $layout = $observer->getLayout();
        $block = $this->config->getHeadBlockReference();
        $stylesheet = $this->config->getCssFilename();

        // Check if file exists first to avoid 404.
        if (!file_exists($this->config->getFullCssFilePath())) {
            $this->logger->debug("$stylesheet does not exist, refusing to add.");
            return;
        }

        $this->_addStylesheet($layout, $block, $stylesheet);
    }


    /**
     * Utility method to generate the XML to add a stylesheet
     *
     * @param Mage_Core_Model_Layout $layout
     * @param string $block
     * @param string $stylesheet
     * @return void
     */
    protected function _addStylesheet($layout, $block, $stylesheet)
    {
        $headBlock = $layout->getBlock($block);
        if ($headBlock instanceof Mage_Page_Block_Html_Head) {
            $this->logger->debug("Adding stylesheet $stylesheet");
            $headBlock->addItem('skin_css', $stylesheet);
        }
    }
}
