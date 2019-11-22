<?php declare(strict_types = 1);

namespace App\Domain\Menu\Item;

use App\Domain\Menu\Item\Exception\ItemCantBeParentToHimselfException;

class Item
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string|null */
    private $parentId;

    /** @var int */
    private $layer;

    public function __construct(string $id, string $name, int $layer, ?string $parentId = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parentId = $parentId;
        $this->layer = $layer;
        $this->assertNotParentToHimself($this->parentId);
    }

    private function assertNotParentToHimself(?string $parentId): void
    {
        if (null !== $parentId && $this->id === $this->parentId) {
            throw new ItemCantBeParentToHimselfException($parentId);
        }
    }

    public function getLayer(): int
    {
        return $this->layer;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function move(string $parentId, int $layer): void
    {
        $this->assertNotParentToHimself($parentId);
        $this->parentId = $parentId;
        $this->layer = $layer;
    }

    public function getParentId(): ?string
    {
        return $this->parentId;
    }
}
