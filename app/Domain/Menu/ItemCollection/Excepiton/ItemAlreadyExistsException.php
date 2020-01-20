<?php declare(strict_types = 1);

namespace App\Domain\Menu\ItemCollection\Excepiton;

use DomainException;

class ItemAlreadyExistsException extends DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Item with id %s already exists!', $id));
    }
}
