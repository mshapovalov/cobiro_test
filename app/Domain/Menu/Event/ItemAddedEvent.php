<?php declare(strict_types = 1);

namespace App\Domain\Menu\Event;

class ItemAddedEvent
{
    /** @var string */
    private $menuId;

    /** @var string */
    private $itemId;

    /** @var ?string */
    private $itemParentId;

    /** @var string */
    private $itemName;

    /** @var int */
    private $itemLayer;

    public function __construct(string $menuId, string $itemId, ?string $itemParentId, string $itemName, int $itemLevel)
    {
        $this->menuId = $menuId;
        $this->itemId = $itemId;
        $this->itemParentId = $itemParentId;
        $this->itemName = $itemName;
        $this->itemLayer = $itemLevel;
    }

    public function getMenuId(): string
    {
        return $this->menuId;
    }

    public function getItemId(): string
    {
        return $this->itemId;
    }

    public function getItemParentId(): ?string
    {
        return $this->itemParentId;
    }

    public function getItemName(): string
    {
        return $this->itemName;
    }

    public function getItemLayer(): int
    {
        return $this->itemLayer;
    }
}
