<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveCommand extends Command
{

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
        // TODO implement remove task feature
    }


}
