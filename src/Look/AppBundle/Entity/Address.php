<?php
namespace Look\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max = 4096)
     */
     protected $country;
     
     
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max = 4096)
     */
     protected $city;
     
     
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max = 4096)
     */
     protected $region;
     
     
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max = 4096)
     */
     protected $street;
     
     
     /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max = 4096)
     */
     protected $number;
     
      /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max = 4096)
     */
     protected $apartment;
     
     public function getId()
    {
        return $this->id;
    }
    
    public function getCountry()
    {
        return $this->country;
    }
    
    public function setCountry($country)
    {
        $this->country = $country;
    }
    
    public function getCity()
    {
        return $this->city;
    }
    
    public function setCity($city)
    {
        $this->city = $city;
    }
    
    public function getRegion()
    {
        return $this->region;
    }
    
    public function setRegion($region)
    {
        $this->region = $region;
    }
    
    public function getStreet()
    {
        return $this->street;
    }
    
    public function setStreet($street)
    {
        $this->street = $street;
    }
    
    public function getNumber()
    {
        return $this->number;
    }
    
    public function setNumber($number)
    {
        $this->number = $number;
    }
    
    public function getApartment()
    {
        return $this->apartment;
    }
    
    public function setApartment($apartment)
    {
        $this->apartment = $apartment;
    }
     
}