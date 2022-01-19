<?php

namespace Codilar\Vendor\Model;

use Magento\Framework\Model\AbstractModel;
use Codilar\Vendor\Model\ResourceModel\Vendor as ResourceModel;

class Vendor extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
