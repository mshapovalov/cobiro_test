<?php declare(strict_types = 1);

namespace App\Domain\Menu\ItemCollection;

use App\Domain\Menu\Exeption\ItemNotExistsException;
use App\Domain\Menu\Item\Item;
use App\Domain\Menu\ItemCollection\Excepiton\ItemAlreadyExistsException;
use Grifix\Demo\Test\Infrastructure\Domain\Menu\ItemCollection\ItemsArrayCollection;
use IteratorAggregate;

interface ItemsCollectionInterface extends IteratorAggregate
{

    public function getById(string $itemId): Item;

    /**
     * @throws ItemAlreadyExistsException
     */
    public function add(Item $item): void;

    public function hasItemWithId(string $itemId): bool;

    public function removeItemById(string $id): void;

    /**
     * @return ItemsCollectionInterface|Item[]
     */
    public function findByLayer(int $layer): ItemsCollectionInterface;

    public function findByParentId(string $parentId): ItemsCollectionInterface;

    public function countItemsOnLayer(int $layer): int;
}
