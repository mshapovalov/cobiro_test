<?php declare(strict_types = 1);

namespace Tests\Unit\Menu;

use App\Domain\Menu\Event\ItemAddedEvent;
use App\Domain\Menu\Event\MenuCreatedEvent;
use App\Domain\Menu\Exeption\TooManyItemsOnLayerException;
use App\Domain\Menu\Exeption\TooManyLayersException;
use App\Domain\Menu\Menu;
use App\Domain\Menu\MenuInfrastructureInterface;
use Grifix\Demo\Test\Infrastructure\Domain\Menu\ItemCollection\ItemsArrayCollection;
use Tests\TestCase;
use Mockery;

class MenuTest extends TestCase
{
    /** @var EventCollector */
    private $eventCollector;

    public function setUp()
    {
        parent::setUp();
        $this->eventCollector = new EventCollector();
    }

    public function testItCreates(): void
    {
        $menu = $this->createMenu('1', 'menu', 5, 10);
        self::assertEquals(1, count($this->eventCollector->getEvents()));
        /** @var MenuCreatedEvent $event */
        $event = $this->eventCollector->getEvents()[0];
        self::assertInstanceOf(MenuCreatedEvent::class, $event);
        self::assertEquals('1', $event->getId());
        self::assertEquals('menu', $event->getName());
        self::assertAttributeEquals(5, 'maxNumOfLayers', $menu);
        self::assertAttributeEquals(10, 'maxItemsPerLayer', $menu);
    }

    public function testItAddsItem(): void
    {
        $menu = $this->createMenu('1', 'menu', 5, 10);
        $menu->addItem('1', 'test');

        /** @var ItemAddedEvent $event */
        $event = $this->eventCollector->getEvents()[1];
        self::assertInstanceOf(ItemAddedEvent::class, $event);
        self::assertEquals('1', $event->getItemId());
        self::assertEquals('test', $event->getItemName());
        self::assertNull($event->getItemParentId());
        self::assertEquals(0, $event->getItemLayer());
    }

    public function testItAddsChildItem(): void
    {
        $menu = $this->createMenu('1', 'menu', 5, 10);
        $menu->addItem('1', 'parent');
        $menu->addItem('2', 'child', '1');
        /** @var ItemAddedEvent $event */
        $event = $this->eventCollector->getEvents()[2];
        self::assertInstanceOf(ItemAddedEvent::class, $event);
        self::assertEquals('2', $event->getItemId());
        self::assertEquals('child', $event->getItemName());
        self::assertEquals('1', $event->getItemParentId());
        self::assertEquals(1, $event->getItemLayer());
    }

    public function testItDoesntAddWhenItemsLimitExceed(): void
    {
        $menu = $this->createMenu('1', 'menu', 10, 1);
        $menu->addItem('1', 'first');
        self::expectException(TooManyItemsOnLayerException::class);
        $menu->addItem('2', 'second');
    }

    public function testItDoesntAddWhenLayersLimitExceed(): void
    {
        $menu = $this->createMenu('1', 'menu', 2, 10);
        $menu->addItem('1', 'first');
        $menu->addItem('2', 'second', '1');
        self::expectException(TooManyLayersException::class);
        $menu->addItem('3', 'third', '2');
    }

    public function testItRemovesItem(): void
    {
        $menu = $this->createMenu('1', 'menu', 100, 100);
        $menu->addItem('1', 'first');
        $menu->removeItem('1');
        $event = $this->eventCollector->getEvents()[1];
    }

    private function createInfrastructureMock(): MenuInfrastructureInterface
    {
        /** @var $eventCollector $eventCollector */
        $eventCollector = $this->eventCollector;
        return Mockery::mock(MenuInfrastructureInterface::class)
            ->shouldReceive('publishEvent')
            ->andReturnUsing(function ($event) use ($eventCollector) {
                $eventCollector->collectEvent($event);
            })->getMock();
    }

    private function createMenu(string $id, string $name, int $maxNumOfLayers, int $maxItemsPerLayer)
    {
        return new Menu(
            $this->createInfrastructureMock(),
            $id,
            $name,
            $maxNumOfLayers,
            $maxItemsPerLayer,
            // I know that I should use mock here but i have not time and use here array implementation
            new ItemsArrayCollection()
        );
    }
}
