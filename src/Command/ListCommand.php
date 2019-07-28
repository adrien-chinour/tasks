<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
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
        // TODO implement listing tasks feature
    }

}
