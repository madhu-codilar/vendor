<?php

namespace Codilar\Vendor\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Codilar\Vendor\Model\ResourceModel\Vendor\CollectionFactory;

class MassDelete extends \Magento\Backend\App\Action
{
protected $filter;
protected $collectionFactory;

public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
{
    $this->filter = $filter;
    $this->collectionFactory = $collectionFactory;
    parent::__construct($context);
}

public function execute()
{
    $collection = $this->filter->getCollection($this->collectionFactory->create());
    $collectionSize = $collection->getSize();

    foreach ($collection as $contact) {
        $contact->delete();
    }

    $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $collectionSize));

    $resultRedirect = $this->resultRedirectFactory->create();
    return $resultRedirect->setPath('*/*/index', array('_current' => true));
}
}