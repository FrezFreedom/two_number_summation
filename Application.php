<?php

require_once ('TwoNumberSummation.php');
require_once('ConsoleIO.php');
require_once ('RepositoryInterface.php');
require_once ('FileRepository.php');
require_once('IOAbstraction.php');

class Application
{
    public function __construct(private TwoNumberSummation  $twoNumberSummation,
                                private IOAbstraction       $io,
                                private RepositoryInterface $repository)
    {
    }

    public function run(): void
    {
        try
        {
            $list = $this->repository->loadNumericList();
            $this->io->printList($list);

            $x = $this->io->readInt();

            $result = $this->twoNumberSummation->solve($x, $list);

            if ($result)
            {
                $this->io->output('Yes, the list has two numbers that sum up to the specified number.');
            }
            else
            {
                $this->io->output('No, the list does not have two numbers that sum up to the specified number.');
            }
        }
        catch (Exception $exception)
        {
            $this->io->output('Exception occurred: ' . $exception->getMessage());
        }
    }
}

