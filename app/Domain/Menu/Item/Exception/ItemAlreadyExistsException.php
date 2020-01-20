<?php declare(strict_types = 1);

namespace App\Domain\Menu\Item\Exception;

use Exception;

class ItemAlreadyExistsException extends Exception
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Item with id %s already exists!', $id));
    }
}
