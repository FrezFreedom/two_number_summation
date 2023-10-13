<?php

require_once ('TwoNumberSummation.php');
require_once ('ConsoleIO.php');
require_once ('RepositoryInterface.php');
require_once ('FileRepository.php');
require_once ('Application.php');
require_once ('FileService.php');


$twoNumberSummation = new TwoNumberSummation();
$io = new ConsoleIO();
$fileService = new FileService();
$fileRepository = new FileRepository('list.txt', $fileService);

$app = new Application($twoNumberSummation, $io, $fileRepository);

$app->run();