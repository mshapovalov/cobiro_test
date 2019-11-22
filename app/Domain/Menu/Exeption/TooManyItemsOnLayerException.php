<?php declare(strict_types = 1);

namespace App\Domain\Menu\Exeption;

use DomainException;
use Throwable;

class TooManyItemsOnLayerException extends DomainException
{
    public function __construct(int $maxItemsOnLayer)
    {
        parent::__construct(sprintf('There cannot be more items on layer than %d', $maxItemsOnLayer));
    }
}
