<?php

namespace Bringo;

class GSCHWithoutZero
{
    protected $numberOfDigits;

    public function __construct($numberOfDigits)
    {
        $this->numberOfDigits = $numberOfDigits;
    }

    public function generate()
    {
        $result = '';
        $zero = '';
        for ($i = 0; $i < $this->numberOfDigits; $i++) {
            $zero = $zero . '0';
        }
        do {
            $result = '';
            for ($i = 0; $i < $this->numberOfDigits; $i++) {
                $binDig = random_int(0, 1);
                $result = $binDig . $result;
            }
        } while ($result === $zero);
        return bindec($result);
    }
}
