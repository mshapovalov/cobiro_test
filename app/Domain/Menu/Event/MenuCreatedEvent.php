<?php declare(strict_types = 1);

namespace App\Domain\Menu\Event;

class MenuCreatedEvent
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
