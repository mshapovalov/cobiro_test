<?php declare(strict_types = 1);

namespace App\Domain\Menu\Exeption;

use DomainException;

class ItemNotExistsException extends DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Item %s does not exits!', $id));
    }
}
