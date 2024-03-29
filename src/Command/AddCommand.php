<?php

namespace App\Command;

use App\Database\TaskRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AddCommand : add a new task.
 *
 * @package App\Command
 */
class AddCommand extends Command
{

    private $repository;

    public function __construct(TaskRepository $repository, $name = null)
    {
        parent::__construct($name);
        $this->repository = $repository;
    }

    protected function configure()
    {
        $this
            ->setName('add')
            ->setDescription('Add a new task')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the task to add')
            ->addOption('category', null, InputOption::VALUE_REQUIRED, 'Add a category to your task', '');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $category = $input->getOption('category');

        $this->repository->add($name, $category);
        $output->writeln("<info>Task correctly added.</info>");
    }

}
