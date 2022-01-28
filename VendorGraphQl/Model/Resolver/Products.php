<?php


namespace Codilar\VendorGraphQl\Model\Resolver;


use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\Resolver\ValueFactory;
use Codilar\Vendor\Model\Vendor;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;

class Products implements ResolverInterface
{
    /**
     * @var ValueFactory
     */
    private $valueFactory;

    /**
     * Details constructor.
     * @param ValueFactory $valueFactory
     */

    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;

    public function __construct(
        ValueFactory $valueFactory,
        ProductRepository $productRepository,
        SearchCriteriaInterface $searchCriteriaInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CollectionFactory $productCollectionFactory
    )
    {
        $this->valueFactory = $valueFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->productRepository=$productRepository;
        $this->searchCriteriaInterface=$searchCriteriaInterface;
        $this->searchCriteriaBuilder=$searchCriteriaBuilder; 
        
    }

    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema.
     *
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return Value|mixed
     * @throws \Exception
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
      $vendorId = $this->getVendorId($args);
      $productData = $this->getProductData($vendorId);
      return $productData;
    }

    private function getVendorId(array $args): int {
      if (!isset($args['vendor_id'])) {
          throw new GraphQlInputException(__('Vendor id should be specified'));
      }
      return (int) $args['vendor_id'];
   }
    /**
     *  Getting data array using data Collection
     */
    private function getProductData(int $vendorId) {
      $collection = $this->productCollectionFactory->create();
      $collection->addAttributeToSelect(['vendor',$vendorId]);
      $collection->setPageSize(3);
      //  $collection = $this->productCollectionFactory->create();
      //  $collection->addAttributeToSelect('*');
      //  $collection = Mage::getModel('catalog/product')->getCollection()->addAttributeToFilter($attributeCode, $vendorId);
      //   return $collection->getItems();
      //  $collection->setPageSize(3); 
     return $collection->getItems();
       
        
    }
}