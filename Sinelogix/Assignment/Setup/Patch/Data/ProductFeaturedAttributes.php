<?php
namespace Sinelogix\Assignment\Setup\Patch\Data;

use Magento\Catalog\Model\Product\Attribute\Frontend\Image as ImageFrontendModel;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class ProductFeaturedAttributes implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'product_features_image_41',
            [
                'type'                    => 'varchar',
                'label'                   => 'Features Image 1',
                'input'                   => 'media_image',
                'frontend'                => ImageFrontendModel::class,
                'required'                => false,
                'sort_order'              => 2,
                'global'                  => ScopedAttributeInterface::SCOPE_STORE,
                'used_in_product_listing' => true,
                'source'                  => Boolean::class,
                'visible'                 => true,
                'user_defined'            => true,
                'visible_on_front'        => false
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'product_features_image_22',
            [
                'type'                    => 'varchar',
                'label'                   => 'Features Image 2',
                'input'                   => 'media_image',
                'frontend'                => ImageFrontendModel::class,
                'required'                => false,
                'sort_order'              => 2,
                'global'                  => ScopedAttributeInterface::SCOPE_STORE,
                'used_in_product_listing' => false,
                'source'                  => Boolean::class,
                'visible'                 => true,
                'user_defined'            => true,
                'visible_on_front'        => false
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'product_features_image_21',
            [
                'type'                    => 'varchar',
                'label'                   => 'Features Image 3',
                'input'                   => 'media_image',
                'frontend'                => ImageFrontendModel::class,
                'required'                => false,
                'sort_order'              => 2,
                'global'                  => ScopedAttributeInterface::SCOPE_STORE,
                'used_in_product_listing' => false,
                'source'                  => Boolean::class,
                'visible'                 => true,
                'user_defined'            => true,
                'visible_on_front'        => false
            ]
        );

        
    }

    /**
     * {@inheritdoc}
     */

    public static function getDependencies() {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases() {
        return [];
    }
}