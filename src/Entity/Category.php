<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(name="category_name", type="text", length=100)
     */
    private $category_name;

    /**
     * @ORM\Column(name="category_status", type="string",columnDefinition="enum('Active','Inactive')")
     */
    private $category_status;
    /**
     * @ORM\Column(name="created_date", type="datetime")
     */
    private $created_date;
 
     /**
     * One product has many users. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Users", mappedBy="category")
     */
    private $users;
    //Getters &  Setters
    public function __construct() {
        $this->users = new ArrayCollection();
    }
    public function getId(){
      return $this->id;
    }
    
    public function getCategoryname(){
      return $this->category_name;
    }
    
    public function setCategoryname($category_name){
      $this->category_name = $category_name;
      return $this;
    }


   public function getCategorystatus(){
      return $this->category_status;
    }

   public function setCategorystatus($category_status){
      $this->category_status = $category_status;
      return $this;

    }

    
   public function getCreateddate(){
      return $this->created_date;
    }

   public function setCreateddate(){
      $this->created_date = new \DateTime("now");
      return $this;

      
    }
    
public function __toString() 
{
    return (string) $this->category_name; 
}


}
