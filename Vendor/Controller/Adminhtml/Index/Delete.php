<?php

namespace Codilar\Vendor\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Action;
use Codilar\Vendor\Model\VendorFactory as ModelFactory;
use Codilar\Vendor\Model\ResourceModel\Vendor as ResourceModel;
use Magento\Framework\App\Action\Context;

class Delete extends Action
{
    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;
    /**
     * Delete Constructor
     * @param Context $context
     * @param ResourceModel $ResourceModel
     * @param ModelFactory $ModelFactory
     */
    public function __construct(
        Context $context,
        ModelFactory $modelFactory,
        ResourceModel $resourceModel
    )
    {
        parent::__construct($context);
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
    }

    public function execute()
    {
        try {
            $model = $this->modelFactory->create();
            $id= $this->getRequest()->getParam('entity_id');
            $model->load($id);
            $model->delete();
            $this->messageManager->addSuccessMessage(__("Successfully deleted"));
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__("Error In Deleteing Vendor"));
        }
        return $this->resultRedirectFactory->create()->setPath('vendor/index/index');
    }
}