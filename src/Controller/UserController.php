<?php
 namespace App\Controller;

 use App\Entity\Category;
 use App\Entity\Users;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Routing\Annotation\Route;
 use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
 use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use Symfony\Component\Form\Extension\Core\Type\SubmitType;
 use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
 use Symfony\Component\Form\Extension\Core\Type\TextType;
 use Doctrine\ORM\EntityManager;
	
class UserController extends Controller{

       /**
        * @Route("/user/index",name="users_list")
        * @Method({"GET","POST"})
        */

        public function index(){
           
           $this->denyAccessUnlessGranted('ROLE_ADMIN');
             $admin = $this->getUser();
             if($admin){

            $users = $this->getDoctrine()->getRepository(Users::class)->findAll();
	  
            return $this->render('usermanagement/users.html.twig',array
            ('users' => $users));
          }
        }
        
         /**
        *@Route("/user/new")
        */
        public function new(Request $request)
        {
          $this->denyAccessUnlessGranted('ROLE_ADMIN');
             $admin = $this->getUser();
             if($admin){

	  $em = $this->getDoctrine()->getManager();
            
          $user = new Users();
	  $groups = $this->getDoctrine()->getRepository(Category::class)->findAll();
           
	   $groupchoices = array();
            foreach($groups as $group){
              $groupchoices[$group->getCategoryname()] = $group->getId();
            }
             
           
           $form = $this->createFormBuilder($user)
                   ->add('Username', TextType::class,array('label' => 'User Name','attr' => array('class' => 'form-control')))
                   ->add('Useremail', TextType::class,array('label' => 'User Email','attr' => array('class' => 'form-control')))
                   ->add('category', ChoiceType::class, [
                      'choices'  => array($groupchoices),
                       'label' => 'User group',
                       'attr' => array('class' => 'form-control')
                     ])

                   ->add('Userstatus', ChoiceType::class, [
                      'choices'  => [
                      'Active' => 'Active',
                      'Inactive' => 'Inactive',
                       ],
                       'label' => 'User Status',
                       'attr' => array('class' => 'form-control')
                     ])
                   ->add('save', SubmitType::class, array('label' => 'Create Group',
                    'attr' => array('class' => 'btn btn-primary mt-3')))
                   ->getForm();


	   $form->handleRequest($request);
	   
           if($form->isSubmitted() && $form->isValid()){ 
	       $category = $this->getDoctrine()->getRepository(Category::class)->find($_POST['form']['category']);
              $user = $form->getData();
              $now = new \DateTime("now");
              $user->setCreateddate($now);
              $user->category = $category;
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($user);
              $entityManager->flush();

              return $this->redirecttoroute('users_list');
           }
          return $this->render('usermanagement/newuser.html.twig',array(
                'form' => $form->createView()
                ));
           }
        }

        /**
        *@Route("/user/show/{id}",name ="user_show")
        */

        public function show($id){
           
           $user = $this->getDoctrine()->getRepository(Users::class)->find($id);
           
           return $this->render('usermanagement/showuser.html.twig',array('user'=> $user));

        }

         /**
        *@Route("/user/edit/{id}")
        */
        public function edit(Request $request, $id)
        {
          $this->denyAccessUnlessGranted('ROLE_ADMIN');
             $admin = $this->getUser();
             if($admin){

          $groups = $this->getDoctrine()->getRepository(Category::class)->findAll();
	
           $groupchoices = array();
           

	    foreach($groups as $group){
               $groupchoices[$group->getCategoryname()] = $group->getId();
	    }
          

          $user = $this->getDoctrine()->getRepository(Users::class)->find($id);
           
           $form = $this->createFormBuilder($user)
                   ->add('Username', TextType::class,array('label' => 'User Name','attr' => array('class' => 'form-control')))
                   ->add('Useremail', TextType::class,array('label' => 'User Email','attr' => array('class' => 'form-control')))
                    ->add('category', ChoiceType::class, [
                     'choices'  => array($groupchoices),
                       'label' => 'User group',
                       'attr' => array('class' => 'form-control')
                     ])

		   ->add('Userstatus', ChoiceType::class, [
                      'choices'  => [
                      'Active' => 'Active',
                      'Inactive' => 'Inactive',
                       ],
                       'label' => 'User Status',
                       'attr' => array('class' => 'form-control')
                     ])
                   ->add('save', SubmitType::class, array('label' => 'Update Group',
                    'attr' => array('class' => 'btn btn-primary mt-3')))
                   ->getForm();

           $form->handleRequest($request);
           
       if($form->isSubmitted() && $form->isValid()){ 
             $category = $this->getDoctrine()->getRepository(Category::class)->find($_POST['form']['category']);
              $user->category = $category;
              $now = new \DateTime("now");
              $user->setCreateddate($now);
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->flush();
            
              return $this->redirecttoroute('users_list');
           
          }
           return $this->render('usermanagement/edituser.html.twig',array(
                'form' => $form->createView()
                ));
            }
        }

        /**
        *@Route("/user/delete")
        *
        */

        public function delete(){
          $this->denyAccessUnlessGranted('ROLE_ADMIN');
             $admin = $this->getUser();
             if($admin){

           $id =  $_POST['id'];
           $user = $this->getDoctrine()->getRepository(Users::class)->find($id);

           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->remove($user);
           $entityManager->flush();
           return new Response("Saved");
           }


        }




}
