<?php

class Loewenstark_MixedFixed_Adminhtml_ProductController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Start product description fixes
     */

    public function indexAction()
    {
        return Mage::getModel('ls_mixedfixed/contentfix')->fixedProduct();
    }

}
