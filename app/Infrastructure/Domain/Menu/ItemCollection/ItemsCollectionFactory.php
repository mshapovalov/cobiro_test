<?php declare(strict_types = 1);

namespace Grifix\Demo\Test\Infrastructure\Domain\Menu\ItemCollection;

use App\Domain\Menu\ItemCollection\ItemsCollectionFactoryInterface;
use App\Domain\Menu\ItemCollection\ItemsCollectionInterface;

class ItemsCollectionFactory implements ItemsCollectionFactoryInterface
{
    public function create(): ItemsCollectionInterface
    {
        return new ItemsArrayCollection();
    }
}
