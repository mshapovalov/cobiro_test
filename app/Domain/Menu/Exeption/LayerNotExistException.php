<?php declare(strict_types = 1);

namespace App\Domain\Menu\Exeption;

use DomainException;

class LayerNotExistException extends DomainException
{
    public function __construct(int $layer)
    {
        parent::__construct(sprintf('Layer %d does not exists!', $layer));
    }
}
