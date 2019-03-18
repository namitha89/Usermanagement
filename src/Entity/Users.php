<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @UniqueEntity("user_email") 
*/
class Users
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
  
    
    /**
     * @ORM\Column(name="user_name", type="text", length=100)
     */
    
    private $user_name;

    /**
     * @ORM\Column(name="user_email", type="text", length=150,unique=true)
     *
     */
    private $user_email;


    /**
     * @ORM\Column(name="user_status", type="string",columnDefinition="enum('Active','Inactive')")
     */
    private $user_status;
    /**
     * @ORM\Column(name="created_date", type="datetime")
     */
    private $created_date;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="users")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", nullable=false)
     * 
     */
    public $category;


    //Getters &  Setters

    public function getId()
    {
        return $this->id;
   } 
    
    public function getUsername(){
      return $this->user_name;
    }

   public function setUsername($user_name){
      $this->user_name = $user_name;
      return $this;
    }

   public function getUseremail(){
      return $this->user_email;
    }

   public function setUseremail($user_email){
      $this->user_email = $user_email;
      return $this;
    }




   public function getUserstatus(){
      return $this->user_status;
    }

   public function setUserstatus($user_status){
      $this->user_status = $user_status;
      return $this;

    }


   public function getCreateddate(){
      return $this->created_date;
    }

   public function setCreateddate(){
      $this->created_date = new \DateTime("now");
      return $this;


    }
   /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }


    /**
     * @param Category $category
     *
     * @return self
     */
    public function setCategory($id)
    {
		
//        $this->category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        return $this;
    }

}
