<?php

namespace Codilar\Vendor\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
Use Codilar\Vendor\Helper\Data;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var Data
     */
    protected $enableData;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Data $enableData
    )
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->enableData=$enableData;
    }

    public function execute()
    {
        if($this->enableData->isEnable()) {
            return $this->pageFactory->create();
        }
        else{
            return $this->resultRedirectFactory->create()->setPath('cms/noroute/index');
        }

    }
}