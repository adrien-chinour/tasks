<?php


namespace App\Command;


use App\Database\TaskRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class UpdateCommand extends Command
{

    private $repository;

    public function __construct(TaskRepository $repository, string $name = null)
    {
        $this->repository = $repository;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('update')
            ->setDescription('Update a task')
            ->addArgument('task', InputArgument::REQUIRED, 'ID of task to update')
            ->addOption('name',null, InputOption::VALUE_REQUIRED, 'New name of the task', null)
            ->addOption('group', null, InputOption::VALUE_REQUIRED, 'New group of the task', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('task');
        $name = $input->getOption('name');
        $group = $input->getOption('group');

        if ($name === null && $group === null) {
            $helper = $this->getHelper('question');
            $output->writeln('<info>Interactive update of the task. Leave blank to unchanged the value.</info>');
            $name = $helper->ask($input, $output, new Question('New name for the task :', null));
            $group = $helper->ask($input, $output, new Question('New group for the task :', null));
        }

        if ($name !== null) {
            $this->repository->updateName($id, $name);
        }

        if ($group !== null) {
            $this->repository->updateGroup($id, $group);
        }

        $output->writeln('<info>Task updated.</info>');
    }

}
