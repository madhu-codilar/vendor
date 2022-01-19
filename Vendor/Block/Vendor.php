<?php
namespace Codilar\Vendor\Block;

use Magento\Catalog\Api\ProductAttributeMediaGalleryManagementInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ProductFactory;


class Vendor extends Template
{
    /**
     * @var Registry
     */
    private  $registry;

    /**
     * @var StockRegistryInterface
     */
    private  $stockRegistry;
    /**
     * @var
     */
    /**
     * @var ProductFactory
     */
    protected $productFactory;

    private $attributeMediaGalleryManagement;
    protected $_storeManager;

    /**
     * @param Template\Context $context
     * @param Registry $registry
     * @param ProductRepository $productRepository
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Registry $registry,
        ProductFactory $productFactory,
        ProductRepository $productRepository,
        ProductAttributeMediaGalleryManagementInterface $attributeMediaGalleryManagement,
        \Magento\Store\Model\StoreManagerInterface $storemanager,
        array $data = []
    )
    {
        parent::__construct($context, $data);

        $this->_storeManager =  $storemanager;
        $this->productFactory = $productFactory;
        $this->registry = $registry;

        $this->attributeMediaGalleryManagement = $attributeMediaGalleryManagement;
    }

    /**
     * @return int
     */
    protected function getCurrentProduct()
    {
        return $this->registry->registry('product');
    }

    public function  getVendorname()
    {
        $product=$this->getCurrentProduct();
        $productSku = $product->getSku();
        return $product->getAttributeText('vendor');
    }


    public function getAttributeID()
    {
        $attrCode='vendor';
        $optLabel= $this->getVendorname();
        $product = $this->productFactory->create();
        $isAttrExist = $product->getResource()->getAttribute($attrCode);
        $optId = '';
        if ($isAttrExist && $isAttrExist->usesSource()) {
            $optId = $isAttrExist->getSource()->getOptionId($optLabel);
        }
        return $optId;
    }

    /**
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getProductImageUsingCode(): string
    {
        $store = $this->_storeManager->getStore();
        return $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product';
    }

    public function getVendorUrl()
    {
        return $this->getUrl('vendor/vendor/index');
    }
}

