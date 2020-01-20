<?php declare(strict_types = 1);

namespace App\Domain\Menu\Exeption;

use DomainException;

class ParentItemDoesNotExistException extends DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Parent item %s does not exist!', $id));
    }
}
