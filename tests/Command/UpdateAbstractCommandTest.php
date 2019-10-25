<?php


namespace Tests\Command;


use App\Command\UpdateCommand;
use Tests\AbstractCommandTest;

class UpdateAbstractCommandTest extends AbstractCommandTest
{
    // TODO add test for interactive update

    protected $commandName = 'update';

    protected $commandClass = UpdateCommand::class;

    public function testUpdateTaskName()
    {
        $id = 1;
        $name = 'new name';

        $this->taskRepositoryMock
            ->expects($this->once())
            ->method('updateName')
            ->with($id, $name);

        $this->commandTester->execute(['task' => $id, '--name' => $name]);

        $this->assertEquals(
            'Task updated.',
            trim($this->commandTester->getDisplay())
        );
    }

    public function testUpdateTaskGroup()
    {
        $id = 1;
        $group = 'new group';

        $this->taskRepositoryMock
            ->expects($this->once())
            ->method('updateGroup')
            ->with($id, $group);

        $this->commandTester->execute(['task' => $id, '--group' => $group]);

        $this->assertEquals(
            'Task updated.',
            trim($this->commandTester->getDisplay())
        );
    }

    public function testUpdateTaskGroupAndName()
    {
        $id = 1;
        $group = 'new group';
        $name = 'new name';

        $this->taskRepositoryMock
            ->expects($this->once())
            ->method('updateGroup')
            ->with($id, $group);

        $this->taskRepositoryMock
            ->expects($this->once())
            ->method('updateName')
            ->with($id, $name);

        $this->commandTester->execute(
            ['task' => $id, '--group' => $group, '--name' => $name]
        );

        $this->assertEquals(
            'Task updated.',
            trim($this->commandTester->getDisplay())
        );
    }
}
