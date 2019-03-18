<?php
 namespace App\Controller;



 use App\Entity\Users;
 use App\Entity\Category;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Routing\Annotation\Route;
 use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
 use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use Symfony\Component\Form\Extension\Core\Type\SubmitType;
 use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
 use Symfony\Component\Form\Extension\Core\Type\TextType;


 class CategoryController extends Controller {

	/**
	* @Route("/",name="group_list")
	* @Method({"GET","POST"})
	*/

	public function index(){

            $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
             
	    return $this->render('usermanagement/category.html.twig',array
            ('categories' => $categories));
	}
	/**
        *@Route("/show/{id}",name ="category_show")
        */
	
	public function show($id){
           
           
	   $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
	   
           return $this->render('usermanagement/show.html.twig',array('category'=> $category));

	}
        /**
        *@Route("/category/new")
        */
        public function new(Request $request)
        {
	  $category = new Category();
           $form = $this->createFormBuilder($category)
                   ->add('Categoryname', TextType::class,array('label' => 'Create Group','attr' => array('class' => 'form-control')))
                   ->add('CategoryStatus', ChoiceType::class, [
                      'choices'  => [
                      'Active' => 'Active',
                      'Inactive' => 'Inactive',
                       ],
                       'label' => 'Group Status',
		       'attr' => array('class' => 'form-control')
                     ])
                   ->add('save', SubmitType::class, array('label' => 'Update Group',
                    'attr' => array('class' => 'btn btn-primary mt-3')))
                   ->getForm();
           $form->handleRequest($request);
           if($form->isSubmitted() && $form->isValid()){
              $category = $form->getData();
              $now = new \DateTime("now");
              $category->setCreateddate($now);
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($category);
	      $entityManager->flush();
              
              return $this->redirecttoroute('group_list');
           }
	  return $this->render('usermanagement/new.html.twig',array(
                'form' => $form->createView()
                ));          

        }
	/**
        *@Route("/category/edit/{id}")
        */
        public function edit(Request $request, $id)
        {
		
          $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
           $form = $this->createFormBuilder($category)
                   ->add('Categoryname', TextType::class,array('label' => 'Create Group','attr' => array('class' => 'form-control')))
                   ->add('CategoryStatus', ChoiceType::class, [
                      'choices'  => [
                      'Active' => 'Active',
                      'Inactive' => 'Inactive',
                       ],
                       'label' => 'Group Status',
                       'attr' => array('class' => 'form-control')
                     ])
                   ->add('save', SubmitType::class, array('label' => 'Create Group',
                    'attr' => array('class' => 'btn btn-primary mt-3')))
                   ->getForm();
           $form->handleRequest($request);
           if($form->isSubmitted() && $form->isValid()){
              
              $now = new \DateTime("now");
              $category->setCreateddate($now);
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->flush();

              return $this->redirecttoroute('group_list');
           }
          return $this->render('usermanagement/edit.html.twig',array(
                'form' => $form->createView()
                ));

        }

        /**
        *@Route("/category/delete")
        *
        */

	public function delete(){
	   
           $id =  $_POST['id'];
           $users = $this->getDoctrine()->getRepository(Users::class)->findOneBy(array('category'=>$id));
           
           if(empty($users)){
                $category = $this->getDoctrine()->getRepository(Category::class)->find($id); 
                $entityManager = $this->getDoctrine()->getMAnager();
                $entityManager->remove($category);
                $entityManager->flush();
                return new Response('Saved');

          }else{
                return new Response('Exists');

           }
           
           
      
          
        }

 }
