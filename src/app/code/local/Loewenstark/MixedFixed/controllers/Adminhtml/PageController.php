<?php

class Loewenstark_MixedFixed_Adminhtml_PageController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Start cms page fixes
     */

    public function indexAction()
    {
        return Mage::getModel('ls_mixedfixed/contentfix')->fixedPage();
    }

}
