<?php

namespace App;

class TwoNumberSummation
{
    public function solve(int $x, array $list): bool
    {
        $existenceCheck = [];

        for ($i = 0; $i < count($list); $i++) {
            $complement = $x - $list[$i];
            if (isset($existenceCheck[$complement])) {
                return true;
            }
            $existenceCheck[$list[$i]] = true;
        }

        return false;
    }
}