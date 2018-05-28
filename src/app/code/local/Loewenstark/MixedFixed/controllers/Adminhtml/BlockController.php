<?php

class Loewenstark_MixedFixed_Adminhtml_BlockController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Start cms block fixes
     */

    public function indexAction()
    {
        return Mage::getModel('ls_mixedfixed/contentfix')->fixedBlock();
    }

}
