<?php

abstract class IOAbstraction
{
    abstract public function input(): string;
    abstract public function output(string $str): void;

    /**
     * @throws Exception
     */
    public function readInt(): int
    {
        $x = $this->input();
        if(!(is_numeric($x) && (int)$x == $x))
        {
            throw new Exception('Input should be integer.');
        }

        return intval($x);
    }

    public function printList(array $list): void
    {
        $this->output('[');

        $firstObject = true;

        foreach ($list as $item)
        {
            if($firstObject)
            {
                $this->output($item);
                $firstObject = false;
            }
            else
            {
                $this->output(', ' . $item);
            }
        }

        $this->output("]\n");
    }
}