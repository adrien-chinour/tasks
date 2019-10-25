<?php

namespace Tests\Command;

use App\Command\AddCommand;
use Tests\AbstractCommandTest;

class AddCommandTest extends AbstractCommandTest
{

    /**
     * amont of tasks to generate to test execute method
     */
    const NUMBER_OF_TASKS = 20;

    protected $commandName = 'add';

    protected $commandClass = AddCommand::class;

    /**
     * @dataProvider tasksWithoutGroupProvider
     *
     * @param $name : task name
     */
    public function testExecuteWithNullGroup($name)
    {
        $this->taskRepositoryMock
            ->expects($this->once())
            ->method('add')
            ->with($name);

        $this->commandTester->execute(['name' => $name]);

        $this->assertEquals(
            'Task correctly added.',
            trim($this->commandTester->getDisplay())
        );
    }

    /**
     * @dataProvider tasksWithGroupProvider
     *
     * @param $name  : task name
     * @param $group : task group
     */
    public function testExecuteWithGroup($name, $group)
    {
        $this->taskRepositoryMock
            ->expects($this->once())
            ->method('add')
            ->with($name, $group);

        $this->commandTester->execute(['name' => $name, '--group' => $group]);

        $this->assertEquals(
            'Task correctly added.',
            trim($this->commandTester->getDisplay())
        );
    }

    /**
     * DataProvider
     * return random tasks name
     *
     * @return array
     */
    public function tasksWithoutGroupProvider()
    {
        $tasks = [];

        for ($i = 0; $i < self::NUMBER_OF_TASKS; $i++) {
            $tasks[] = [uniqid() . "_$i"];
        }

        return $tasks;
    }

    /**
     * DataProvider
     * return random tasks with a group
     *
     * @return array
     */
    public function tasksWithGroupProvider()
    {
        $tasks = [];

        for ($i = 0; $i < self::NUMBER_OF_TASKS; $i++) {
            $name = uniqid() . "_$i";
            $group = uniqid();
            $tasks[] = [$name, $group];
        }

        return $tasks;
    }

}
