<?php

namespace Codilar\Vendor\Block;

use Magento\Framework\View\Element\Template;
use Codilar\Vendor\Model\Vendor;
use Codilar\Vendor\Model\ResourceModel\Vendor\CollectionFactory;

class VendorList extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return emp[]
     */
    public function getVendor()
    {
        $collection = $this->collectionFactory->create();
        return $collection->getItems();
    }
    public function getVendorUrl()
    {
        return $this->getUrl('vendor/vendor/index');
    }
}
