<?php declare(strict_types = 1);

namespace App\Domain\Menu;

interface MenuFactoryInterface
{
    public function create(
        string $id,
        string $name,
        ?int $maxNumOfLayers = null,
        ?int $maxItemsPerLayer = null
    ): MenuInterface;
}
