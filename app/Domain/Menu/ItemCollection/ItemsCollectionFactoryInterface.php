<?php declare(strict_types = 1);

namespace App\Domain\Menu\ItemCollection;

use App\Domain\Menu\ItemCollection\ItemsCollectionInterface;

interface ItemsCollectionFactoryInterface
{
    public function create(): ItemsCollectionInterface;
}
