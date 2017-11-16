<?php

class Meanbee_ConfigPoweredCss_Adminhtml_ConfigPoweredCssController extends Mage_Adminhtml_Controller_Action
{
    public function regenerateAction()
    {
        /** @var Mage_Adminhtml_Model_Session $session */
        $session = Mage::getSingleton('adminhtml/session');

        try {
            Mage::helper('meanbee_configpoweredcss')->regenerateConfigPoweredCss();
        } catch (Exception $e) {
            $session->addError($e->getMessage());
            $this->_redirect('*/cache');
            return;
        }

        $session->addSuccess("Successfully regenerated CSS file(s)");
        $this->_redirect('*/cache');
    }
}
