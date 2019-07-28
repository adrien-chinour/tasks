<?php


namespace App\Entity;


class Task
{

    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $group;

    /** @var boolean */
    private $done;

    /**
     * Task constructor.
     *
     * @param string $name
     * @param string $group
     */
    public function __construct(string $name, string $group)
    {
        $this->name = $name;
        $this->group = $group;
        $this->done = false;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Task
     */
    public function setName(string $name): Task
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @param string $group
     *
     * @return Task
     */
    public function setGroup(string $group): Task
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->done;
    }

    /**
     * @param bool $done
     *
     * @return Task
     */
    public function setDone(bool $done): Task
    {
        $this->done = $done;

        return $this;
    }

}
