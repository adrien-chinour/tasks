<?php

namespace App\Command;

use App\Database\TaskManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ListCommand : list tasks to do.
 *
 * @package App\Command
 */
class ListCommand extends Command
{

    /**
     * @var TaskManager
     */
    private $taskManager;

    /**
     * ListCommand constructor.
     *
     * @param TaskManager $taskManager
     * @param null        $name
     */
    public function __construct(TaskManager $taskManager, $name = null)
    {
        parent::__construct($name);

        $this->taskManager = $taskManager;
    }

    public function configure()
    {
        $this
            ->setName('all')
            ->setAliases(['ls'])
            ->setDescription('List all tasks')
            ->addOption('group', 'g', InputOption::VALUE_REQUIRED, 'Filter tasks list by group');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $tasks = $this->taskManager->list($input->getOption('group'));

        if(empty($tasks)) {
            $output->writeln('<info>no task found.</info>');
            exit(0);
        }

        $table = new Table($output);
        $table
            ->setHeaders(['ID', 'Name', 'Group', 'Done'])
            ->setRows($tasks);

        $table->render();
    }

}
