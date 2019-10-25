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
            ->addOption('category', null, InputOption::VALUE_REQUIRED, 'New category of the task', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('task');
        $name = $input->getOption('name');
        $category = $input->getOption('category');

        if ($name === null && $category === null) {
            $helper = $this->getHelper('question');
            $output->writeln('<info>Interactive update of the task. Leave blank to unchanged the value.</info>');
            $name = $helper->ask($input, $output, new Question('New name for the task :', null));
            $category = $helper->ask($input, $output, new Question('New category for the task :', null));
        }

        if ($name !== null) {
            $this->repository->updateName($id, $name);
        }

        if ($category !== null) {
            $this->repository->updateCategory($id, $category);
        }

        $output->writeln('<info>Task updated.</info>');
    }

}
