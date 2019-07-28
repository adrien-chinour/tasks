<?php

namespace App\Command;

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

    protected function configure()
    {
        $this
            ->setName('add')
            ->setAliases(['a'])
            ->setDescription('Add a new task')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the task to add')
            ->addOption('group', 'g', InputOption::VALUE_REQUIRED, 'Add a group to your task');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // TODO implement adding task feature
    }

}
