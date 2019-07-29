<?php

namespace App\Command;

use App\Database\TaskRepository;
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

    private $repository;

    public function __construct(TaskRepository $repository, $name = null)
    {
        parent::__construct($name);
        $this->repository = $repository;
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
        $tasks = $this->repository->list($input->getOption('group'));

        if (empty($tasks)) {
            $output->writeln('<info>no task found.</info>');
            exit(0);
        }

        $this->renderTasks($output, $tasks);
    }

    private function renderTasks(OutputInterface $output, $tasks)
    {
        $table = new Table($output);
        $table
            ->setHeaders(['ID', 'Name', 'Group', 'Completed'])
            ->setRows($tasks);

        $table->render();
    }

}
