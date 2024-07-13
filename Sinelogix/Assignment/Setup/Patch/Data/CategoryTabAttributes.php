<?php
namespace Sinelogix\Assignment\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CategoryTabAttributes implements DataPatchInterface
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
            \Magento\Catalog\Model\Category::ENTITY,
            'kitchen_rug',
            [
                'type' => 'text',
                'label' => 'Kitchen',
                'input' => 'textarea',
                'source' => '',
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => null,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'group' => 'General Information',
                'backend' => ''
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'bathroom_rug',
            [
                'type' => 'text',
                'label' => 'Bathroom',
                'input' => 'textarea',
                'source' => '',
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => null,
                'group' => 'General Information',
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'backend' => ''
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'bedroom_rug',
            [
                'type' => 'text',
                'label' => 'Bedroom',
                'input' => 'textarea',
                'sort_order' => 333,
                'source' => '',
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => null,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'group' => 'General Information',
                'backend' => ''
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'living_room_rug',
            [
                'type' => 'text',
                'label' => 'Living Room',
                'input' => 'textarea',
                'sort_order' => 333,
                'source' => '',
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => null,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'group' => 'General Information',
                'backend' => ''
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'dining_room_rug',
            [
                'type' => 'text',
                'label' => 'Dining Room',
                'input' => 'textarea',
                'sort_order' => 333,
                'source' => '',
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => null,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'group' => 'General Information',
                'backend' => ''
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'outdoor_rug',
            [
                'type' => 'text',
                'label' => 'Outdoor',
                'input' => 'textarea',
                'sort_order' => 333,
                'source' => '',
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => null,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'group' => 'General Information',
                'backend' => ''
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'entryway_rug',
            [
                'type' => 'text',
                'label' => 'Entryway',
                'input' => 'textarea',
                'sort_order' => 333,
                'source' => '',
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => null,
                'wysiwyg_enabled' => true,
                'is_html_allowed_on_front' => true,
                'group' => 'General Information',
                'backend' => ''
            ]
        );

    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [
        
        ];
    }
}