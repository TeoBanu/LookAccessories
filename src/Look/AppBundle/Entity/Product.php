<?php
namespace Look\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max = 100)
     */
     protected $name;
     
     
    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
	 * @Assert\Type(type="float")
     * @Assert\Range(min = 0)
     */
     protected $price;
     
     
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max = 100)
     */
     protected $category;
     
     
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(min = 0)
     */
     protected $stock;
     
     
     /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(max = 50)
     */
     protected $brand;
     
      /**
     * @ORM\Column(type="string", length=1000)
     * @Assert\Length(max = 1000)
     */
     protected $description;
     
     public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
    }
    
    public function getCategory()
    {
        return $this->category;
    }
    
    public function setCategory($category)
    {
        $this->category = $category;
    }
    
    public function getStock()
    {
        return $this->stock;
    }
    
    public function setStock($stock)
    {
        $this->stock = $stock;
    }
    
    public function getBrand()
    {
        return $this->brand;
    }
    
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
    }
     
}