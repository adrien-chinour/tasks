<?php

namespace App\Command;

use App\Database\TaskManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckCommand : check or uncheck task
 *
 * @package App\Command
 */
class CheckCommand extends Command
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
            ->setName('check')
            ->setDescription('Ckeck or uncheck task')
            ->addArgument('task', InputArgument::REQUIRED, 'ID of task to check or uncheck')
            ->addOption('uncheck', 'u', InputOption::VALUE_NONE, 'To uncheck a task');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('uncheck')) {
            $this->taskManager->uncheck($input->getArgument('task'));
            $output->writeln('<info>Task unchecked.</info>');
        } else {
            $this->taskManager->check($input->getArgument('task'));
            $output->writeln('<info>Task checked</info>');
        }
    }

}
