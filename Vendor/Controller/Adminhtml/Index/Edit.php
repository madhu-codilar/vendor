<?php

namespace Codilar\Vendor\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Codilar\Vendor\Model\VendorFactory as ModelFactory;
use Codilar\Vendor\Model\ResourceModel\Vendor as ResourceModel;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;
     /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;


    public function __construct(
        Context $context,
        PageFactory $pageFactory, 
        ModelFactory $modelFactory,
        ResourceModel $resourceModel
    )
    {
        
        $this->pageFactory = $pageFactory;
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
        parent::__construct($context);
    }

    public function execute()
    {
        $page=$this->pageFactory->create();
        $data=$this->getRequest()->getParams();
        $Vendor = $this->modelFactory->create();
        $Vendor->load($data['entity_id']);
        $page->getConfig()->getTitle()->set('Vendor '. $Vendor->getVendorName()."'s Details");
        return $page;
    }
}
