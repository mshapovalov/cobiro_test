<?php declare(strict_types = 1);

namespace App\Domain\Menu;

interface MenuInfrastructureInterface
{
    public function publishEvent(object $event): void;
}
