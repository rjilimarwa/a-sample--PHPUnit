<?php


namespace AppBundle\Utilities;

class Calculator
{
public function add($a,$b)
{
    return $a+$b;
}
public function substract($a,$b)
{
    return $a - $b;
}
static function isPair($nb)
{
   return  $nb%2==0;

}

}