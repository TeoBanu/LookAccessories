<?php
namespace Look\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 */
class CartProduct
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="cartProducts")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     **/
    protected $cart;
    
    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     **/
    protected $product;
    
    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 1,
     * )
     */
    protected $quantity;

    public function getId()
    {
        return $this->id;
    }
    
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function setCart($cart) {
        $this->cart = $cart;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    
}