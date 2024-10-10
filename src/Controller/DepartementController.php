<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Entity\User;
use App\Form\DepartementType;
use App\Repository\DepartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @Route("/departement")
 */
class DepartementController extends AbstractController
{
    /**
     * @Route("/", name="app_departement", methods={"GET"})
     */
    public function index(DepartementRepository $departementRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Departement::class);
        $departements = $repository->findAll();
 
        return $this->render("departement/ldepartement.html.twig", array('departements' => $departements));
    }

    /**
     * @Route("/new", name="app_departement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DepartementRepository $departementRepository): Response
    {
        $departement = new Departement();
        $form = $this->createForm(DepartementType::class, $departement);
        $form->handleRequest($request);

       

        if ($form->isSubmitted() && $form->isValid()) {
            $nom = $form->get('nom')->getData();
            $libDep = $form->get('lib_dep')->getData();
            $description=$form->get('description')->getData();
            $datecreation=$form->get('datecreation')->getData();
           
           
            $departement->setNom($nom);
            $departement->setLibDep($libDep);
            $departement->setDescription($description);
            $departement->setDatecreation($datecreation);
           
          
            $em = $this->getDoctrine()->getManager();
            $em->persist($departement);
            $em->flush();
            return $this->redirectToRoute('app_departement');
        }

        return $this->renderForm('departement/new.html.twig', [
            'departement' => $departement,
            'form' => $form,
        ]);
    }

 
    /**
     * @Route("/{id}", name="app_departement_show", methods={"GET"})
     */
    public function show($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repositoryDep = $em->getRepository(Departement::class);
        $repositoryUser = $em->getRepository(User::class);

        $user = $repositoryDep->find($id);
        $ets = $repositoryDep->findUser($user);
     
       
        return $this->renderForm('departement/show.html.twig', [
            'departement' => $user,
            'userDep' => $ets,
        ]);
       
    }

    /**
     * @Route("/{id}/edit", name="app_departement_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Departement $departement, DepartementRepository $departementRepository): Response
    {
        $form = $this->createForm(DepartementType::class, $departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departementRepository->add($departement);
            return $this->redirectToRoute('app_departement', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('departement/edit.html.twig', [
            'departement' => $departement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_departement_delete", methods={"POST"})
     */
    public function delete(Request $request, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $repository = $em->getRepository(Departement::class);
        $departements = $repository->find($request->get('id'));
        $em->remove($departements);
        $em->flush();

        return $this->redirectToRoute('app_departement');
    }
}
