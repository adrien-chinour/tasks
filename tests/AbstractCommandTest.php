<?php

namespace Tests;

use App\Database\TaskRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class AbstractCommandTest
 *
 * @package Tests\Command
 * @
 */
class AbstractCommandTest extends TestCase
{

    protected $commandName = null;

    protected $commandClass = null;

    /**
     * @var CommandTester
     */
    protected $commandTester;

    /**
     * @var MockObject|TaskRepository
     */
    protected $taskRepositoryMock;

    /**
     * Setup application before each test
     */
    protected function setUp()
    {
        if ($this->commandClass == null || $this->commandName == null) {
            throw new \LogicException('This attributes should be defined');
        }

        $this->taskRepositoryMock = $this->getMockBuilder(TaskRepository::class)
                                         ->disableOriginalConstructor()
                                         ->getMock();

        $application = new Application();
        $application->add(new $this->commandClass($this->taskRepositoryMock));
        $command = $application->find($this->commandName);
        $this->commandTester = new CommandTester($command);
    }

    /**
     * Clean up after running a test
     */
    protected function tearDown()
    {
        $this->taskRepositoryMock = null;
        $this->commandTester = null;
    }

}
