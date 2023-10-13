<?php

require_once ('app/TwoNumberSummation.php');
require_once ('app/Application.php');
require_once ('io/ConsoleIO.php');
require_once ('repository/FileService.php');
require_once ('repository/RepositoryInterface.php');
require_once ('repository/FileRepository.php');


$twoNumberSummation = new TwoNumberSummation();
$io = new ConsoleIO();
$fileService = new FileService();
$fileRepository = new FileRepository('list.txt', $fileService);

$app = new Application($twoNumberSummation, $io, $fileRepository);

$app->run();