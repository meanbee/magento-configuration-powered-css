<?php

class Meanbee_ConfigPoweredCss_Adminhtml_ConfigPoweredCssController extends Mage_Adminhtml_Controller_Action
{
    public function regenerateAction()
    {
        /** @var Mage_Adminhtml_Model_Session $session */
        $session = Mage::getSingleton('adminhtml/session');

        /** @var Meanbee_ConfigPoweredCss_Model_Css $css */
        $css = Mage::getModel('meanbee_configpoweredcss/css');

        $stores = Mage::app()->getStores();
        foreach ($stores as $storeId => $store) {
            try {
                $css->publish($storeId);
            } catch (Exception $e) {
                $session->addError($e->getMessage());
                $this->_redirect('*/cache');
                return;
            }
        }

        $session->addSuccess("Successfully regenerated CSS file(s)");
        $this->_redirect('*/cache');
    }
}
