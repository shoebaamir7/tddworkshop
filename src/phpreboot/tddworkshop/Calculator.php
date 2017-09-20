<?php

namespace phpreboot\tddworkshop;

class Calculator
{
    public function add($numbers = '',$method='add')
    {
        $negativeNumbersArray = array();
        if (empty($numbers)) {
            return 0;
        }
        /* Check if New Delimeter */
        $checkArrayDelimeter = explode('\\', $numbers);
        if(empty($checkArrayDelimeter[0]) && empty($checkArrayDelimeter[1])){
            $numbers = str_replace("$checkArrayDelimeter[2]",",","$checkArrayDelimeter[4]");
        }
        /*Replace \n with comma ,*/
        $numbers = str_replace('\n',",","$numbers");
        if (!is_string($numbers)) {
            throw new \InvalidArgumentException('Parameters must be a string');
        }
        /*Convert numbers string into array*/
        $numbersArray = explode(",", $numbers);
        if (array_filter($numbersArray, 'is_numeric') !== $numbersArray) {
            throw new \InvalidArgumentException('Parameters string must contain numbers');
        }
        /* Check for numbers greater than 1000 and negative numbers*/
        foreach ($numbersArray as $key => $value) {
            if($value > 1000){
                unset($numbersArray[$key]);
            }
            if($value < 0){
                $negativeNumbersArray[] = $value;
            }
        }
        if(count($negativeNumbersArray) > 0){
            throw new \InvalidArgumentException('Negative numbers('.implode (", ",$negativeNumbersArray).') not allowed.');
        }
        if($method == 'multiply'){
            return array_product($numbersArray);
        }
        return array_sum($numbersArray);
    }
    
}