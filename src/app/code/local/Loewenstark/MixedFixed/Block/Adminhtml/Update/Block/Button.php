<?php

class Loewenstark_MixedFixed_Block_Adminhtml_Update_Block_Button extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
        $url = Mage::helper('adminhtml')->getUrl('adminhtml/block', array('_secure' => true));

        $html = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setType('button')
            ->setClass('scalable')
            ->setLabel('Fix now!')
            ->setOnClick("setLocation('$url')")
            ->toHtml();

        return $html;
    }
}

?>