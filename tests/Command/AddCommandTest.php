<?php

namespace Tests\Command;

use App\Command\AddCommand;
use App\Database\TaskRepository;
use PHPUnit\Framework\MockObject\MockObject;
use \PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class AddCommandTest extends TestCase
{

    /**
     * amont of tasks to generate to test execute method
     */
    const NUMBER_OF_TASKS = 20;

    /**
     * @var CommandTester
     */
    private $commandTester;

    /**
     * @var MockObject|TaskRepository
     */
    private $taskRepositoryMock;

    /**
     * Setup application before each test
     */
    protected function setUp()
    {
        $this->taskRepositoryMock = $this->getMockBuilder(TaskRepository::class)
                                         ->disableOriginalConstructor()
                                         ->getMock();

        $application = new Application();
        $application->add(new AddCommand($this->taskRepositoryMock));
        $command = $application->find('add');
        $this->commandTester = new CommandTester($command);
    }

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
     * Clean up after running a test
     */
    protected function tearDown()
    {
        $this->taskRepositoryMock = null;
        $this->commandTester = null;
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
