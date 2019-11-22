<?php declare(strict_types = 1);

namespace App\Domain\Menu\Item\Exception;

use DomainException;

class ItemCantBeParentToHimselfException extends DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Item %s cannot be parent to himself!', $id));
    }
}
