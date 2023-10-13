<?php

require_once (__DIR__ . '/../IOAbstraction.php');

class StringIOMock extends IOAbstraction
{
    private string $inputString;
    private string $outputString;

    public function __construct(string $inputString)
    {
        $this->inputString = $inputString;
        $this->outputString = '';
    }

    public function input(): string
    {
        return $this->inputString;
    }

    public function output(string $str): void
    {
        $this->outputString .= $str;
    }

    public function getOutput(): string
    {
        return $this->outputString;
    }
}