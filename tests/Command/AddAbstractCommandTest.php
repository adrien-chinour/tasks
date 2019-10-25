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
     * @dataProvider tasksWithoutCategoryProvider
     *
     * @param $name : task name
     */
    public function testExecuteWithNullCategory($name)
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
     * @dataProvider tasksWithCategoryProvider
     *
     * @param $name  : task name
     * @param $category : task category
     */
    public function testExecuteWithCategory($name, $category)
    {
        $this->taskRepositoryMock
            ->expects($this->once())
            ->method('add')
            ->with($name, $category);

        $this->commandTester->execute(['name' => $name, '--category' => $category]);

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
    public function tasksWithoutCategoryProvider()
    {
        $tasks = [];

        for ($i = 0; $i < self::NUMBER_OF_TASKS; $i++) {
            $tasks[] = [uniqid() . "_$i"];
        }

        return $tasks;
    }

    /**
     * DataProvider
     * return random tasks with a category
     *
     * @return array
     */
    public function tasksWithCategoryProvider()
    {
        $tasks = [];

        for ($i = 0; $i < self::NUMBER_OF_TASKS; $i++) {
            $name = uniqid() . "_$i";
            $category = uniqid();
            $tasks[] = [$name, $category];
        }

        return $tasks;
    }

}
