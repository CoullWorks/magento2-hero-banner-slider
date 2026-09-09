<?php
/**
 * CoullWorks Banner Slider for Magento 2.
 *
 * @author    danrcoull <ttechitsolutions@gmail.com>
 * @copyright Copyright (c) 2020-2026 CoullWorks
 * @license   Proprietary — see LICENSE.txt
 * @link      https://github.com/CoullWorks/magento2-hero-banner-slider
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Carry data over from the pre-rebrand BoxLeafDigital_BannerSlider tables.
 *
 * Runs once on setup:upgrade. It is idempotent and safe on a fresh install:
 * for each entity it only copies rows when the old table exists and the new
 * table is still empty, so it never clobbers data or runs twice.
 */
class MigrateFromBoxLeafDigital implements DataPatchInterface
{
    /**
     * old table => new table
     */
    private const TABLE_MAP = [
        'boxleafdigital_bannerslider_banners' => 'coullworks_banner_slider_banners',
        'boxleafdigital_bannerslider_bannerslider' => 'coullworks_banner_slider_bannerslider',
    ];

    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup
    ) {
    }

    /**
     * @inheritDoc
     */
    public function apply(): self
    {
        $connection = $this->moduleDataSetup->getConnection();
        $this->moduleDataSetup->startSetup();

        foreach (self::TABLE_MAP as $old => $new) {
            $oldTable = $connection->getTableName($old);
            $newTable = $connection->getTableName($new);

            if (!$connection->isTableExists($oldTable) || !$connection->isTableExists($newTable)) {
                continue;
            }

            $existing = (int) $connection->fetchOne(
                $connection->select()->from($newTable, 'COUNT(*)')
            );
            if ($existing > 0) {
                continue;
            }

            // Copy only the columns both tables share (they are identical apart
            // from the table name, but this stays safe if a schema drifts).
            $shared = array_values(array_intersect(
                array_keys($connection->describeTable($oldTable)),
                array_keys($connection->describeTable($newTable))
            ));
            if (!$shared) {
                continue;
            }

            $columns = implode(', ', array_map([$connection, 'quoteIdentifier'], $shared));
            $connection->query(sprintf(
                'INSERT INTO %s (%s) SELECT %s FROM %s',
                $connection->quoteIdentifier($newTable),
                $columns,
                $columns,
                $connection->quoteIdentifier($oldTable)
            ));
        }

        $this->moduleDataSetup->endSetup();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
