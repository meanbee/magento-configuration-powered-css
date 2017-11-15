<?php
require_once __DIR__ . '/../../abstract.php';

class Meanbee_Configpoweredcss_Regenerate extends Mage_Shell_Abstract
{

    /**
     * Run script
     *
     */
    public function run()
    {

        /**
         * Shell script regenerate the configpowered css for all stores
         */

        try {

            /** @var Meanbee_ConfigPoweredCss_Model_Css $css */
            $css = Mage::getModel('meanbee_configpoweredcss/css');

            $stores = Mage::app()->getStores();
            foreach ($stores as $storeId => $store) {
                try {
                    Mage::app()->setCurrentStore($storeId);
                    $css->publish($storeId);
                } catch (Exception $e) {
                    Mage::logException($e);
                    return;
                }
            }

            fwrite(STDERR,
                "Config powered css has been regenerated successfully.\n");
            exit(0);
        } catch (Exception $e) {
            Mage::logException($e);

            fwrite(STDERR,
                "There was an error when regenerating the config powered css, it has been logged.\n");
            exit(1);
        }
    }
}

$shell = new Meanbee_Configpoweredcss_Regenerate();
$shell->run();