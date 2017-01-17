<?php

/**
 * This file is part of learning package.
 *
 * Class converts decimal integers numbers into binary and vice versa.
 */
class Number
{
    /**
     * @var int|string
     */
    private $number;

    /**
     * Number is decimal ?
     *
     * @var bool
     */
    private $type;

    /**
     * Number constructor.
     * @param $number
     * @param bool $type
     */
    public function __construct($number, $type = true)
    {
        $this->number = $number;
        $this->type = $type;
    }

    /**
     * Converting number
     */
    public function convert()
    {
        if ($this->type) {
            $this->number = $this->convertToBinary($this->number);
        } else {
            $this->number = $this->convertToDecimal($this->number);
        }
    }

    /**
     * Convert decimal number to binary for integers.
     * An analogue of the built-in functions decbin( int $number )
     *
     * @param $number int|string
     * @return string
     */
    private function convertToBinary($number)
    {
        $negative = '';
        if ($number < 0) {
            $negative = '-';
        }

        $binaryNumber = [];
        $number = abs($number);
        while ($number != 0) {
            array_unshift($binaryNumber, $number % 2);
            $number = (int)($number / 2);
        }

        return $negative.implode($binaryNumber);
    }

    /**
     * Convert decimal number to decimal for binary string.
     * An analogue of the built-in functions bindec ( string $binary_string )
     *
     * @param $number
     * @return string
     */
    private function convertToDecimal($number)
    {
        $decimalNumber = 0;
        $array = str_split($number);
        $negative = '';
        if ($array[0] == '-') {
            $negative = '-';
            unset($array[0]);
        }
        foreach ($array as $key => $value) {
            $decimalNumber += ((int)$value * pow(2, count($array) - 1));
            unset($array[$key]);
        }

        return $negative.$decimalNumber;
    }

    /**
     * Return the object as a string or int (if decimal)
     * @return string
     */
    public function __toString()
    {
        return (string)$this->number;
    }
}

$a = new Number(125);
$a->convert();
echo $a."\n";

$a = new Number('1111101', false);
$a->convert();
echo $a."\n";
