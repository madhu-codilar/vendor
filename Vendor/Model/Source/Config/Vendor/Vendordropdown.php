<?php
namespace Codilar\Vendor\Model\Source\Config\Vendor;



class Vendordropdown extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    protected $collections;

    public function __construct(
        \Codilar\Vendor\Model\ResourceModel\Vendor\Collection $collections
    ) {
        $this->collections = $collections;
    }

    public function getAllOptions()
    {
        

        if (null === $this->_options) {
            $this->_options[] = [
                'label' => '.',
                'value' => 'null'

            ];


            foreach($this->collections as $collection) {
                
                if ($collection->getIsActive()) {
                    $this->_options[] = [
                        
                        'label' => $collection->getVendorName(),
                        'value' => $collection->getEntityId()
                    ];
                }
            }
        }
        return $this->_options;
    }
}