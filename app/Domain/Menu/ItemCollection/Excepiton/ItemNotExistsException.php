<?php declare(strict_types = 1);

namespace App\Domain\Menu\ItemCollection\Excepiton;

use DomainException;

class ItemNotExistsException extends DomainException
{
    public function __construct(string $itemId)
    {
        parent::__construct(sprintf('Item not %s not exists!', $itemId));
    }
}
