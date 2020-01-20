<?php declare(strict_types = 1);

namespace App\Domain\Menu;

use App\Domain\Menu\Event\ItemAddedEvent;
use App\Domain\Menu\Event\MenuCreatedEvent;
use App\Domain\Menu\Exeption\LayerNotExistException;
use App\Domain\Menu\Exeption\ParentItemDoesNotExistException;
use App\Domain\Menu\Exeption\TooManyItemsOnLayerException;
use App\Domain\Menu\Exeption\TooManyLayersException;
use App\Domain\Menu\Item\Item;
use App\Domain\Menu\ItemCollection\ItemsCollectionInterface;

class Menu implements MenuInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var int|null */
    private $maxNumOfLayers;

    /** @var int|null */
    private $maxItemsPerLayer;

    /** @var ItemsCollectionInterface|Item[] */
    private $items;

    /** @var MenuInfrastructureInterface */
    private $infrastructure;

    public function __construct(
        MenuInfrastructureInterface $infrastructure,
        string $id,
        string $name,
        ?int $maxNumOfLayers,
        ?int $maxItemsPerLayer,
        ItemsCollectionInterface $items
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->maxNumOfLayers = $maxNumOfLayers;
        $this->maxItemsPerLayer = $maxItemsPerLayer;
        $this->items = $items;
        $this->infrastructure = $infrastructure;
        $this->infrastructure->publishEvent(new MenuCreatedEvent($this->id, $this->name));
    }

    public function addItem(string $id, string $name, ?string $parentId = null): void
    {
        if (null !== $parentId && !$this->items->hasItemWithId($parentId)) {
            throw new ParentItemDoesNotExistException($parentId);
        }

        $layer = $this->calculateItemLayer($parentId);
        if ($layer >= $this->maxNumOfLayers) {
            throw new TooManyLayersException($this->maxNumOfLayers);
        }
        if ($this->items->countItemsOnLayer($layer) >= $this->maxItemsPerLayer) {
            throw new TooManyItemsOnLayerException($this->maxItemsPerLayer);
        }
        $this->items->add(new Item($id, $name, $layer));
        $this->infrastructure->publishEvent(new ItemAddedEvent(
            $this->id,
            $id,
            $parentId,
            $name,
            $layer
        ));
    }

    public function removeItem(string $id): void
    {
        $item = $this->items->getById($id);
        foreach ($this->items->findByParentId($item->getId()) as $childItem) {
            /** @var Item $childItem */
            $this->removeItem($childItem->getId());
        }
        $this->items->removeItemById($id);
    }

    public function removeLayer(int $layer): void
    {
        if (!$this->hasLayer($layer)) {
            throw new LayerNotExistException($layer);
        }
        foreach ($this->items->findByLayer($layer) as $item) {
            $this->removeItemFromLayer($item);
        }
    }

    private function hasLayer(int $layer): bool
    {
        foreach ($this->items as $item) {
            if ($item->getLayer() <= $layer) {
                return true;
            }
        }
        return false;
    }

    private function removeItemFromLayer(Item $item): void
    {
        foreach ($this->items as $subItem) {
            if ($subItem->getParentId() === $item->getId()) {
                $subItem->move($item->getParentId(), $item->getLayer());
            }
        }
    }

    private function calculateItemLayer(?string $parentId): int
    {
        if (null === $parentId) {
            return 0;
        }
        return $this->items->getById($parentId)->getLayer() + 1;
    }
}
