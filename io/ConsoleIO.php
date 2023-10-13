<?php

namespace Io;

class ConsoleIO extends IOAbstraction
{
    public function input(): string
    {
        return readline();
    }
    public function output(string $str): void
    {
        print($str);
    }
}