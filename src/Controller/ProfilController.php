<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Departement;
use App\Form\ProfileeditType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="app_profil")
     */
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
    /**
     * @Route("/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function editAction(User $user,Request $request,UserPasswordHasherInterface $userPasswordHasher) {
    
        $form = $this->createForm(PofileeditType::class,$user);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           /** @var Article $article */
           $user = $form->getData();
           $image = $form->get('image')->getData();
           $fileName = $image->getClientOriginalName();
           $image->move($this->getParameter('upload_directory'), $fileName);
           $user->setPassword(
               $userPasswordHasher->hashPassword(
                       $user,
                       $form->get('password')->getData()
                   )
               );
               $user->setImage($fileName);
           $em = $this->getDoctrine()->getManager();
       
           $em->persist($user);
           $em->flush();
           $this->addFlash('success', 'User Created! Knowledge is power!');
           return $this->redirectToRoute('app_userlist');
       }
       return $this->render('profil/index.html.twig', array('user' => $user, 'form' => $form->createView()));

    
      
   }
}
