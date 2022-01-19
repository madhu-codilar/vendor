<?php

namespace Codilar\Vendor\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Codilar\Vendor\Model\Vendor as Model;
use Codilar\Vendor\Model\ResourceModel\Vendor as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
