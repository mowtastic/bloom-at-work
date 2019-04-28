<?php

namespace BloomAtWork\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use LogicException;

class QuestionStatsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('bloom:stats:question')
            ->addArgument('file', InputArgument::REQUIRED, "CSV file to extract stats from");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!is_file($file = $input->getArgument('file'))) {
            throw new LogicException("No such file {$input->getArgument('file')}");
        }

        // TODO implements here
    }
}