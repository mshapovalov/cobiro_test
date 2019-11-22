<?php declare(strict_types = 1);

namespace Grifix\Demo\Test\Infrastructure\Domain\Menu\ItemCollection;

use ArrayIterator;
use App\Domain\Menu\Exeption\ItemNotExistsException;
use App\Domain\Menu\Item\Item;
use App\Domain\Menu\ItemCollection\Excepiton\ItemAlreadyExistsException;
use App\Domain\Menu\ItemCollection\ItemsCollectionInterface;

class ItemsArrayCollection implements ItemsCollectionInterface
{
    /** @var Item[] */
    private $items = [];


    /**
     * @param Item[] $items
     */
    public function __construct($items = [])
    {
        $this->items = $items;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    public function getById(string $itemId): Item
    {
        $this->assertItemExists($itemId);
        return $this->items[$itemId];
    }

    public function hasItemWithId(string $itemId): bool
    {
        return array_key_exists($itemId, $this->items);
    }

    /**
     * @throws ItemAlreadyExistsException
     */
    public function add(Item $item): void
    {
        if ($this->hasItemWithId($item->getId())) {
            throw new ItemAlreadyExistsException($item->getId());
        }
        $this->items[$item->getId()] = $item;
    }

    private function assertItemExists(string $itemId): void
    {
        if (!$this->hasItemWithId($itemId)) {
            throw new ItemNotExistsException($itemId);
        }
    }

    public function removeItemById(string $id): void
    {
        $this->assertItemExists($id);
        unset($this->items[$id]);
    }

    public function findByLayer(int $layer): ItemsCollectionInterface
    {
        $result = [];
        foreach ($this->items as $item) {
            if ($item->getLayer() === $layer) {
                $result[$item->getId()] = $item;
            }
        }
        return new self($result);
    }


    public function findByParentId(string $parentId): ItemsCollectionInterface
    {
        $result = [];
        foreach ($this->items as $item) {
            if ($item->getParentId() === $parentId) {
                $result[$item->getId()] = $item;
            }
        }
        return new self($result);
    }

    public function countItemsOnLayer(int $layer): int
    {
        $result = 0;
        foreach ($this->items as $item) {
            if ($layer === $item->getLayer()) {
                $result++;
            }
        }
        return $result;
    }
}
