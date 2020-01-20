<?php declare(strict_types = 1);

namespace App\Domain\Menu;

use App\Domain\Menu\ItemCollection\ItemsCollectionFactoryInterface;

class MenuFactory implements MenuFactoryInterface
{
    /** @var ItemsCollectionFactoryInterface */
    private $itemsCollectionFactory;

    /** @var MenuInfrastructureInterface */
    private $menuInfrastructure;

    public function __construct(
        ItemsCollectionFactoryInterface $itemsCollectionFactory,
        MenuInfrastructureInterface $menuInfrastructure
    )
    {
        $this->itemsCollectionFactory = $itemsCollectionFactory;
        $this->menuInfrastructure = $menuInfrastructure;
    }

    public function create(
        string $id,
        string $name,
        ?int $maxNumOfLayers = null,
        ?int $maxItemsPerLayer = null
    ): MenuInterface {
        return new Menu(
            $this->menuInfrastructure,
            $id,
            $name,
            $maxNumOfLayers,
            $maxItemsPerLayer,
            $this->itemsCollectionFactory->create()
        );
    }
}
