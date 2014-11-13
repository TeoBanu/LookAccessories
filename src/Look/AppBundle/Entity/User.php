<?php
namespace Look\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User
{
	/**
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     **/
    protected $address;
	
	/**
     * @ORM\OneToMany(targetEntity="Cart", mappedBy="user")
     **/
	protected $carts;
	
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank()
     */	
	protected $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max = 4096)
     */
    protected $password;
	
	 /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $first_name;
	
	 /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $last_name;
	
	 /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $gender;
	
	 /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $email;
	
	 /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $phone_number;
	
	 /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $is_admin;
	
	public function __construct() {
        $this->carts = new ArrayCollection();
    }
	
	public function getIsAdmin() 
	{
		return $this->is_admin;
	}
	
	public function setIsAdmin($is_admin)
	{
		$this->is_admin = $is_admin;
	}
	
	public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }
	
	public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

	public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }
	
	public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
	
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }
	
	public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }
	
    public function getId()
    {
        return $this->id;
    }
	
	
	public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($user)
    {
        $this->username = $user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}