<?php

class Loewenstark_MixedFixed_Model_Contentfix
{

    /**
     * @return mixed
     */

    public function getBaseUrl()
    {
        $baseUrl = Mage::getBaseUrl();
        if (strpos($baseUrl, 'https') !== false) {
            return str_replace(array('https://', '/index.php', 'www.'), '', Mage::getBaseUrl());
        } else {
            return str_replace(array('http://', '/index.php', 'www.'), '', Mage::getBaseUrl());
        }
    }

    /**
     * Redirect user to main setup page
     */

    public function redirectToSetup()
    {
        $response = Mage::app()->getResponse();
        $response->clearHeaders()
            ->setRedirect(Mage::helper('adminhtml')->getUrl('adminhtml/system_config'))
            ->sendHeadersAndExit();
    }

    /**
     * @return Mage_Catalog_Model_Resource_Product_Collection|object
     */

    public function getProducts()
    {
        $products = Mage::getModel('catalog/product')->getCollection();
        $products->addAttributeToSelect('*');
        return $products;
    }

    /**
     * Fix product description
     * http => https
     */

    public function fixedProduct()
    {
        $baseUrl = $this->getBaseUrl();
        $products = $this->getProducts();
        foreach ($products as $product) {
            $sku = $product->getSku();
            $id = Mage::getModel('catalog/product')->getIdBySku($sku);
            $description = $product->getDescription();
            $descriptionFixed = str_replace(array('http://' . $baseUrl, 'http://www.' . $baseUrl), 'https://www.' . $baseUrl, $description);
            if ($id) {
                $data = array(
                    'description' => $descriptionFixed,
                );
                Mage::getSingleton('catalog/product_action')->updateAttributes(array($id), $data, 0);
            }
        }
        echo 'Product description was fixed!';
    }

    /**
     * @return Mage_Catalog_Model_Resource_Category_Collection|object
     * @throws Mage_Core_Exception
     */

    public function getCategory()
    {
        $category = Mage::getModel('catalog/category')->getCollection();
        $category->addAttributeToSelect('*');
        return $category;
    }

    /**
     * Fix category description
     * http => https
     * @throws Exception
     * @throws Mage_Core_Exception
     */

    public function fixedCategory()
    {
        $category = $this->getCategory();
        $baseUrl = $this->getBaseUrl();
        $resource = Mage::getResourceModel('catalog/category');
        foreach ($category as $cat) {
            $description = $cat->getDescription();
            $descriptionFixed = str_replace(array('http://' . $baseUrl, 'http://www.' . $baseUrl), 'https://www.' . $baseUrl, $description);
            $cat->setData('description', $descriptionFixed);
            $resource->saveAttribute($cat, 'description');
        }
        echo 'Category description was fixed!';
    }

    /**
     * @return Mage_Core_Model_Abstract|Mage_Core_Model_Resource
     */

    public function getResource()
    {
        return Mage::getSingleton('core/resource');
    }

    /**
     * @param $tableName
     */

    public function fixedCMS($tableName)
    {
        $resource = $this->getResource();
        $pageTable = $resource->getTableName($tableName);
        $writeConnection = $resource->getConnection('core_write');
        $baseUrl = $this->getBaseUrl();

        $pageUpdateVol1 = "UPDATE $pageTable SET content = REPLACE(content, 'http://www." . $baseUrl . "', 'https://www." . $baseUrl . "') WHERE content LIKE '%http://www." . $baseUrl . "%'";
        $pageUpdateVol2 = "UPDATE $pageTable SET content = REPLACE(content, 'http://" . $baseUrl . "', 'https://www." . $baseUrl . "') WHERE content LIKE '%http://" . $baseUrl . "%'";

        $writeConnection->query($pageUpdateVol1);
        $writeConnection->query($pageUpdateVol2);
        echo 'CMS was fixed!';
    }

    /**
     * Fix cms pages
     * http => https
     */

    public function fixedPage()
    {
        return $this->fixedCMS('cms/page');
    }

    /**
     * Fixed cms block
     * http => https
     */

    public function fixedBlock()
    {
        return $this->fixedCMS('cms/block');
    }
}

