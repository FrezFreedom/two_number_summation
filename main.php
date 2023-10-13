<?php

require 'vendor/autoload.php';

use App\TwoNumberSummation;
use App\Application;
use Io\ConsoleIO;
use Repository\FileService;
use Repository\FileRepository;

$twoNumberSummation = new TwoNumberSummation();
$io = new ConsoleIO();
$fileService = new FileService();
$fileRepository = new FileRepository('list.txt', $fileService);

$app = new Application($twoNumberSummation, $io, $fileRepository);

$app->run();