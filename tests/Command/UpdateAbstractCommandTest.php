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

    public function testUpdateTaskCategory()
    {
        $id = 1;
        $category = 'new category';

        $this->taskRepositoryMock
            ->expects($this->once())
            ->method('updateCategory')
            ->with($id, $category);

        $this->commandTester->execute(['task' => $id, '--category' => $category]);

        $this->assertEquals(
            'Task updated.',
            trim($this->commandTester->getDisplay())
        );
    }

    public function testUpdateTaskCategoryAndName()
    {
        $id = 1;
        $category = 'new category';
        $name = 'new name';

        $this->taskRepositoryMock
            ->expects($this->once())
            ->method('updateCategory')
            ->with($id, $category);

        $this->taskRepositoryMock
            ->expects($this->once())
            ->method('updateName')
            ->with($id, $name);

        $this->commandTester->execute(
            ['task' => $id, '--category' => $category, '--name' => $name]
        );

        $this->assertEquals(
            'Task updated.',
            trim($this->commandTester->getDisplay())
        );
    }
}
