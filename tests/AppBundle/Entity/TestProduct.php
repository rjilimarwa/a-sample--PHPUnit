<?php


namespace tests\AppBundle\Entity;
use AppBundle\Entity\Product;
use PHPUnit\Framework\TestCase;
/**
 * Create the test class Product
 */

class TestProduct extends TestCase
{
    /**
     * @dataProvider pricesForFoodProduct
     */
    public function testcomputeTVAFoodProduct($price, $expectedTva)
    {
            $product = new Product('Un produit', Product::FOOD_PRODUCT, $price);

            $this->assertSame($expectedTva, $product->computeTVA());
    }
    public function pricesForFoodProduct()
    {
            return
            [
            [0, 0.0],
            [20, 1.1],
            [100, 5.5]
            ];
    }
    /**
     *  create a new method  to create a product with a different type,
     * then call the method to test and finally write in an assertion the expected result
     */
    public function  testcomputerTVAoutherProduct()
    {
             $product=new Product('un outher product','un outher product',20);
             $this->assertSame(3.92,$product->computeTVA());
    }
    /**
     *  create a new method  to  generate negative prices

     */
    public  function testNegativePriceComputeTVA()
    {

        $product=new Product('un produit',Product::FOOD_PRODUCT,-20);
        $this->expectException('logicException');
        $product->computeTVA();
    }
}