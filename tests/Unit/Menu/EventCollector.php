<?php declare(strict_types = 1);

namespace Tests\Unit\Menu;

class EventCollector
{
    /** @var object[] */
    private $events = [];

    public function collectEvent(object $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return object[]
     */
    public function getEvents(): array
    {
        return $this->events;
    }
}
