<?php

class Loewenstark_MixedFixed_Adminhtml_CategoryController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Start category description fixes
     */

    public function indexAction()
    {
        return Mage::getModel('ls_mixedfixed/contentfix')->fixedCategory();
    }

}
