<?php

namespace Bringo;

class GSCHWithoutZero
{
    protected $numberOfDigits;
    protected $zero;

    public function __construct($numberOfDigits)
    {
        $zero = '';
        for ($i = 0; $i < $numberOfDigits; $i++) {
            $zero = $zero . '0';
        }
        $this->numberOfDigits = $numberOfDigits;
        $this->zero = $zero;
    }

    public function generate()
    {
        $result = '';
        do {
            $result = '';
            for ($i = 0; $i < $this->numberOfDigits; $i++) {
                $binDig = random_int(0, 1);
                $result = $binDig . $result;
            }
        } while ($result === $this->zero);
        return bindec($result);
    }
}
