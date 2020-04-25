<?php

namespace Iop\OrderGrid\Setup\Patch\Data;

use Magento\Framework\App\State;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class FillOrderColumnsInOrderGridColumns
 */
class FillOrderColumnsInOrderGridColumns implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var State
     */
    private $state;

    /**
     * PatchInitial constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        State $state
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->state = $state;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '1.0.0';
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->state->emulateAreaCode(
            \Magento\Backend\App\Area\FrontNameResolver::AREA_CODE,
            [$this, 'fillOrderColumnsInOrderGridColumns'],
            [$this->moduleDataSetup]
        );
    }

    /**
     * Fill Order Columns In Order Grid Columns.
     *
     * @param ModuleDataSetupInterface $setup
     */
    public function fillOrderColumnsInOrderGridColumns(ModuleDataSetupInterface $setup)
    {
        $gridTable = $setup->getTable('sales_order_grid');
        $updateOrderGrid = $setup->getConnection()
            ->select()
            ->joinInner(
                ['sales_order' => $setup->getTable('sales_order')],
                $gridTable . '.entity_id = sales_order.entity_id',
                ['coupon_code' => 'sales_order.coupon_code', 'discount_amount' => 'sales_order.discount_amount']
            )
            ->where(
                'sales_order.coupon_code IS NOT NULL'
            )->orWhere('sales_order.discount_amount IS NOT NULL');

        $updateOrderGrid = $setup->getConnection()->updateFromSelect(
            $updateOrderGrid,
            $gridTable
        );
        $setup->getConnection()->query($updateOrderGrid);
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
