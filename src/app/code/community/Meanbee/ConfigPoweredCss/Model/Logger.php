<?php

class Meanbee_ConfigPoweredCss_Model_Logger implements Meanbee_ConfigPoweredCss_Model_LoggerInterface
{
    protected $_filename;
    protected $_enabled = false;

    /**
     * Meanbee_ConfigPoweredCss_Model_Logger constructor.
     *
     * @param array $arguments
     * @param Meanbee_ConfigPoweredCss_Model_Config|null $config
     */
    public function __construct($arguments, Meanbee_ConfigPoweredCss_Model_Config $config = null)
    {
        $config = is_null($config) ? Mage::getSingleton('meanbee_configpoweredcss/config') : $config;

        $this->_filename = $config->getLogFilename();
        $this->_enabled = $config->isEnabled() && $config->isLoggingEnabled();
    }

    /**
     * @param $message
     * @param $level
     */
    protected function _writeLog($message, $level)
    {
        if (!$this->_enabled) {
            return;
        }

        Mage::log($message, $level, $this->_filename, true);
    }

    /**
     * @param string $message
     * @return $this
     */
    public function alert($message)
    {
        $this->_writeLog($message, Zend_Log::ALERT);
        return $this;
    }

    /**
     * @param mixed $severity
     * @param string $message
     * @return $this
     */
    public function log($severity, $message)
    {
        $this->_writeLog($message, $severity);
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function debug($message)
    {
        $this->_writeLog($message, Zend_Log::DEBUG);
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function info($message)
    {
        $this->_writeLog($message, Zend_Log::INFO);
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function notice($message)
    {
        $this->_writeLog($message, Zend_Log::NOTICE);
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function warning($message)
    {
        $this->_writeLog($message, Zend_Log::WARN);
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function error($message)
    {
        $this->_writeLog($message, Zend_Log::ERR);
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function critical($message)
    {
        $this->_writeLog($message, Zend_Log::CRIT);
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function emergency($message)
    {
        $this->_writeLog($message, Zend_Log::EMERG);
        return $this;
    }
}