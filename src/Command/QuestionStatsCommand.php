<?php

namespace BloomAtWork\Command;

use BloomAtWork\Model\Question;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use LogicException;

class QuestionStatsCommand extends Command
{
    const MIN_VALUE = 'min';
    const MAX_VALUE = 'max';
    const MEAN_VALUE = 'mean';

    protected function configure()
    {
        $this
            ->setName('bloom:stats:question')
            ->addArgument('file', InputArgument::REQUIRED, "CSV file to extract stats from");
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!is_file($file = $input->getArgument('file'))) {
            throw new LogicException("No such file {$input->getArgument('file')}");
        }

        $question = $this->createQuestion($file);
        $output->writeln('Question ');
        $output->writeln(' - Label : ' . $question->getLabel());
        $output->writeln(' - Maximum value : ' . $question->getMax());
        $output->writeln(' - Minimum value : ' . $question->getMin());
        $output->writeln(' - Mean value : ' . $question->getMean());
    }

    private function parseCSV(string $filename)
    {
        $stats = [];
        if (($h = fopen("{$filename}", "r")) !== FALSE)
        {
            while (($data = fgetcsv($h, 1000, ",")) !== FALSE)
            {
                foreach ($data as $line)
                {
                    if (is_string($line) && !isset($stats['label'])) {
                        $stats['label'] = $line;
                    } else {
                        $stats['values'][] = (float)$line;
                    }
                }
            }

            fclose($h);
        }

        return $stats;
    }

    /**
     * @param array  $values
     * @param string $typeValue
     *
     * @return float|null
     */
    private function getTypeValue(array $values, string $typeValue)
    {
        $value = null;
        switch ($typeValue)
        {
            case self::MAX_VALUE:
                $value = max($values);
                break;

            case self::MIN_VALUE:
                $value = min($values);
                break;

            case self::MEAN_VALUE:
                $value = round(array_sum($values) / count($values), 2);
                break;
        }

        return $value;
    }

    /**
     * @param string $file
     *
     * @return Question
     */
    private function createQuestion(string $file)
    {
        $parsedQuestion = $this->parseCSV($file);
        $label = $parsedQuestion['label'];
        $maxValue = $this->getTypeValue($parsedQuestion['values'], self::MAX_VALUE);
        $minValue = $this->getTypeValue($parsedQuestion['values'], self::MIN_VALUE);
        $meanValue = $this->getTypeValue($parsedQuestion['values'], self::MEAN_VALUE);

        return new Question($label, $maxValue, $minValue, $meanValue);
    }

}