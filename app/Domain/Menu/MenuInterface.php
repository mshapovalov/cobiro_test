<?php declare(strict_types = 1);

namespace App\Domain\Menu;

interface MenuInterface
{
    public function addItem(string $id, string $name, ?string $parentId = null): void;

    public function removeItem(string $id): void;

    public function removeLayer(int $layer): void;
}
