<?php

namespace App\Controller;

use App\Entity\Processus;
use App\Entity\User;
use App\Form\ProcessusType;
use App\Repository\ProcessusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @Route("/processus")
 */
class ProcessusController extends AbstractController
{
    /**
     * @Route("/", name="app_processus", methods={"GET"})
     */
    public function index(ProcessusRepository $processusRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Processus::class);
        $processuss = $repository->findAll();
 
        return $this->render("processus/lprocessus.html.twig", array('processuss' => $processuss));
    }

         /**
     * @Route("/new", name="app_processus_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProcessusRepository $processusRepository): Response
    {
        $processus = new Processus();
        $form = $this->createForm(ProcessusType::class, $processus);
        $form->handleRequest($request);

    
        if ($form->isSubmitted() && $form->isValid()) {
            $nom = $form->get('nom')->getData();
            $libprocessus = $form->get('libprocessus')->getData();
            $datecreation = $form->get('datecreation')->getData();
            $description = $form->get('description')->getData();
            foreach( $form->get('userproc')->getData() as $i => $item) {
             
            
                $processus->addUserprocessu($item);
                  
                   }
           
            $processus->setNom($nom);
            $processus->setLibprocessus($libprocessus);
            $processus->setDescription($description);
            $processus->setDatecreation($datecreation);
           
          
            $em = $this->getDoctrine()->getManager();
            $em->persist($processus);
            $em->flush();
            return $this->redirectToRoute('app_processus');
        }

        return $this->renderForm('processus/new.html.twig', [
            'processus' => $processus,
            'form' => $form,
        ]);
    }

    
    /**
     * @Route("/{id}/edit", name="app_processus_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Processus $processu, ProcessusRepository $processusRepository): Response
    {
        $form = $this->createForm(ProcessusType::class, $processu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $processusRepository->add($processu);
            return $this->redirectToRoute('app_processus', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('processus/edit.html.twig', [
            'processu' => $processu,
            'form' => $form,
        ]);
    }
    /**
    * @Route("/{id}", name="app_processus_show", methods={"GET"})
     */
    public function show($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repositoryProc = $em->getRepository(Processus::class);
        $repositoryUser = $em->getRepository(User::class);
       
        $processus = $repositoryProc->find($id);
        $userProc = $repositoryProc->findUserByProcessus($id);

    
        return $this->renderForm('processus/show.html.twig', [
            'processus' => $processus,
            'userProc' => $userProc,
        ]);
    }
        /**
     * @Route("/{id}", name="app_processus_delete", methods={"POST"})
     */
    public function delete(Request $request, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $repository = $em->getRepository(Processus::class);
        $processuss = $repository->find($request->get('id'));
        $em->remove($processuss);
        $em->flush();

        return $this->redirectToRoute('app_processus');
    }

}
