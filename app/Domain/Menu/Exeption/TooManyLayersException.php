<?php declare(strict_types = 1);

namespace App\Domain\Menu\Exeption;

use DomainException;

class TooManyLayersException extends DomainException
{
    public function __construct(int $maxNumberOfLayers)
    {
        parent::__construct(sprintf('There cannot be more layers than %d', $maxNumberOfLayers));
    }
}
