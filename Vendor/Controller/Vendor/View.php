<?php

namespace Codilar\Vendor\Controller\Vendor;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
Use Codilar\Vendor\Helper\Data;

class View extends Action
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;

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

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
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
