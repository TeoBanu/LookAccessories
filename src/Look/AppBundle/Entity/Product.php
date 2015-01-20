<?php
namespace Look\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
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
     
     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;

    private $temp;

    /**
     * @Assert\File( maxSize = "1024k", mimeTypesMessage = "Please upload a valid Image")
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : '/'.$this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/images';
    }

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