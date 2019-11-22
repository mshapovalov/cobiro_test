<?php declare(strict_types = 1);

namespace App\Domain\Menu\Event;

class ItemRemovedEvent
{
    /** @var string */
    private $itemId;

    public function __construct(string $itemId)
    {
        $this->itemId = $itemId;
    }

    public function getItemId(): string
    {
        return $this->itemId;
    }
}
