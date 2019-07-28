<?php


namespace App\Command;


use App\Database\TaskManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RemoveCommand : remove a task
 *
 * @package App\Command
 */
class RemoveCommand extends Command
{

    private $taskManager;

    public function __construct(TaskManager $taskManager, $name = null)
    {
        parent::__construct($name);

        $this->taskManager = $taskManager;
    }

    protected function configure()
    {
        $this
            ->setName('remove')
            ->setAliases(['rm'])
            ->setDescription('Remove task(s)')
            ->addArgument('task', InputArgument::IS_ARRAY, 'ID of task(s) to be removed');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($input->getArgument('task') as $id) {
            $this->taskManager->remove($id);
        }

        $output->writeln('<info>Task(s) removed.</info>');
    }


}
