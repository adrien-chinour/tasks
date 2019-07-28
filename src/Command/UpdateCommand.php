<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('update')
            ->setAliases(['up'])
            ->setDescription('Update a task')
            ->addArgument('task', InputArgument::IS_ARRAY, 'ID of task to be updated');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // TODO implement update task feature
    }
}
