<?php

/**
 * Created by PhpStorm.
 * User: pc-tarek
 * Date: 07/06/2018
 * Time: 14:59
 */
namespace Tests\AppBundle\Utilities;
use PHPUnit\Framework\TestCase;
use AppBundle\Utilities\Calculator;

class CalculatorTest extends TestCase
{
public function testAdd()
{
    $calculator=new Calculator();
    $result=$calculator->add(10,3);
    $this->assertEquals(13,$result);

}
    public function testsubstract()
    {
        $calculator=new Calculator();
        $result=$calculator->substract(10,3);
        $this->assertEquals(7,$result);


    }
    public function testisPair()
    {


        $this->assertEquals(Calculator::isPair(5),false);


    }
}