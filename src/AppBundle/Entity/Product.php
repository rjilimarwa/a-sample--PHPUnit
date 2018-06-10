<?php




namespace AppBundle\Entity;
/**
 * Class Product
 * @package AppBundle\Entity
 */

class Product
{
    /**
     * Creates les properties  d'entity Product.
     *
     */

    const FOOD_PRODUCT = 'food';

    private $name;

    private $type;

    private $price;

    /**
     * Product constructor.
     * @param $name
     * @param $type
     * @param $price
     */
    public function __construct($name, $type, $price)
    {
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
    }
    /**
     * Create  a Function in charge of calculating VAT.
     *
     */
    public function computeTVA()
    {
        if($this->price<0)
        {
            throw new \LogicException('The TVA cannot be negative.');
        }
        if (self::FOOD_PRODUCT == $this->type) {
            return $this->price * 0.055;
        }

        return $this->price * 0.196;
    }

}