<?php
namespace Look\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="carts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    protected $user;
    
    /**
     * @ORM\OneToMany(targetEntity="CartProduct", mappedBy="cart")
     **/
    protected $cartProducts;
    
     /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank()
     */ 
    protected $is_cart;
    
    public function __construct() {
        $this->cartProducts = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getCartProducts()
    {
        return $this->cartProducts;
    }

    public function addCartProduct($cartProduct)
    {
        $this->cartProducts->add($cartProduct);
    }

    public function getIsCart()
    {
        return $this->is_cart;
    }

    public function setIsCart($is_cart)
    {
        $this->is_cart = $is_cart;
    }
}