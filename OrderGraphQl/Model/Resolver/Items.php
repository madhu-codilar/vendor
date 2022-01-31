<?php
declare(strict_types=1);
 
namespace Codilar\OrderGraphQl\Model\Resolver;
 
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ValueFactory;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\CatalogGraphQl\Model\Resolver\Product\Websites\Collection;
 
/**
 * Retrieves the Items information object
 */
class Items implements ResolverInterface
{
    /**
     * Get All Product Items of Order.
     * @inheritdoc
     */

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Sales\Model\ResourceModel\Order\Item\CollectionFactory $itemCollection
    
    ) {
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->itemCollection=$itemCollection;
       
    }
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        // if (!isset($value['items'])) {
        //      return null;
        // }
        // $itemArray = [];
        // foreach ($value['items'] as $key => $item) {
        //     $itemArray[$key]['sku'] = $item['sku'];
        //     $itemArray[$key]['title'] = $item['name'];
        //     $itemArray[$key]['price'] = $item['price'];
        // }
        // return $itemArray;
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('entity_id', 1,'gteq')->create();
        $products = $this->productRepository->getList($searchCriteria)->getItems();

        $productRecord['items'] = [];
        foreach($products as $product) {
            
            $productId = $product->getId();
            $itemCollection = $this->itemCollection->create()
            ->addFieldToFilter('product_id',$productId);
            
            if($itemCollection->getTotalCount()>=2){ 
            $productRecord['items'][$productId] = $product->getData();   
            }
        }

        return $productRecord;
    }
}