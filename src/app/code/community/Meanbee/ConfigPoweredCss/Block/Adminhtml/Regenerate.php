<?php

class Meanbee_ConfigPoweredCss_Block_Adminhtml_Regenerate extends Mage_Adminhtml_Block_Template
{

    /**
     * Get URL that triggers regeneration
     *
     * @return string
     */
    public function getRegenerateUrl()
    {
        return $this->getUrl('*/configpoweredcss/regenerate');
    }
}