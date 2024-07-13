<?php
namespace Sinelogix\Assignment\Model;

use Exception;
use Magento\Catalog\Api\Data\CategoryAttributeInterface;
use Magento\Catalog\Api\CategoryAttributeRepositoryInterface;

class CategoryAttributeInfo
{
    /**
     * @var CategoryAttributeRepositoryInterface
     */
    private $categoryAttributeInfo;

    public function __construct(
        CategoryAttributeRepositoryInterface $categoryAttributeInfo
    ) {
        $this->categoryAttributeInfo = $categoryAttributeInfo;
    }

    /**
     * Category attribute information
     *
     * @param string $categoryAttributeCode
     * @return CategoryAttributeInterface
     */
    public function getCategoryAttribute($categoryAttributeCode)
    {
        $categoryAttributeData = [];
        try {
            $categoryAttributeData = $this->categoryAttributeInfo->get($categoryAttributeCode);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return $categoryAttributeData;
    }
}