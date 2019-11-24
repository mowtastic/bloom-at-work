<?php

namespace BloomAtWork\Tests;

use BloomAtWork\Command\QuestionStatsCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use LogicException;


class QuestionStatsCommandTest extends TestCase
{
    /**
     * @var CommandTester
     */
    private $commandTester;

    public function setUp()
    {
        parent::setUp();
        $application = new Application();
        $application->add(new QuestionStatsCommand());
        $command = $application->find('bloom:stats:question');
        $this->commandTester = new CommandTester($command);
    }

    public function testExecute()
    {
        $filename = 'resources/example.csv';
        $this->commandTester->execute(['file' => $filename]);

        $this->assertContains('Question', trim($this->commandTester->getDisplay()));
        $this->assertContains('Label : # Je fais confiance à mon manager', trim($this->commandTester->getDisplay()));
        $this->assertContains('Maximum value : 9.7', trim($this->commandTester->getDisplay()));
        $this->assertContains('Minimum value : 6.1', trim($this->commandTester->getDisplay()));
        $this->assertContains('Mean value : 7.29', trim($this->commandTester->getDisplay()));
    }

    public function testExecuteNotFoundCSV()
    {
        $filename = 'resources/not_exist.csv';

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage(sprintf("No such file %s", $filename));

        $this->commandTester->execute(['file' => $filename]);
    }
}