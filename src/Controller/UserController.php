<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Departement;
use App\Entity\Processus;
use App\Form\UserType;
use App\Form\EdituserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class UserController extends AbstractController
{
      /**
     * @Route("/userlist", name="app_userlist")
     */
    public function index()
    {
        
       
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(User::class);
        $users = $repository->findAll();

        return $this->render('user/userlist.html.twig', [
            'users' => $users,
        
    
        ]);
        
    }
      /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository,UserPasswordHasherInterface $userPasswordHasher)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $fullname = $form->get('fullname')->getData();
            $tel = $form->get('tel')->getData();
            $image = $form->get('image')->getData();
            $roles = $form->get('roles')->getData();

            foreach( $form->get('departements')->getData() as $i => $item) {
             
            
                $user->addDepartement($item);
                  
                   }
                   if($image != null) {
                    $fileName = $image->getClientOriginalName();
                    $image->move($this->getParameter('upload_directory'), $fileName);
                    $user->setImage($fileName);
                   }

           
           
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );
               
            $user->setEmail($email);
            $user->setRoles($roles);
            $user->setFullname($fullname);
            $user->setTel($tel);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
      
               
          
            return $this->redirectToRoute('app_userlist');
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function editAction(User $user,Request $request,UserPasswordHasherInterface $userPasswordHasher) {
    
         $form = $this->createForm(EdituserType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Article $article */
            $user = $form->getData();
     
            $em = $this->getDoctrine()->getManager();
        
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'User Created! Knowledge is power!');
            return $this->redirectToRoute('app_userlist');
        }
        return $this->render('user/edit.html.twig', array('user' => $user, 'form' => $form->createView()));

     
       
    }
     /**
     * @Route("/{id}", name="app_user_delete", methods={"POST"})
     */
    public function deleteAction(Request $request, ManagerRegistry $doctrine) {
        $em = $doctrine->getManager();
        $repository = $em->getRepository(User::class);
        $users = $repository->find($request->get('id'));
        $em->remove($users);
        $em->flush();

        return $this->redirectToRoute('app_userlist');
    }
     /**
     * @Route("/{id}", name="app_user_show", methods={"GET"})
     */
    public function show($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $repositoryUser = $em->getRepository(User::class);

        $user = $repositoryUser->find($id);
        $departements = $repositoryUser->findUserByDepartement($id);
        $processus = $repositoryUser->findUserByProcessus($id);

       

        return $this->render('user/show.html.twig', [
            'departements' => $departements,
            'user' => $user,
            'processus' => $processus,

        ]);
    }
}