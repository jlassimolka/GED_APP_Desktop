<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use  App\Entity\Document;
use  App\Entity\Categorie;
use  App\Entity\Upload;
use Doctrine\Persistence\ManagerRegistry;
use  App\Form\DocumentType;
use App\Repository\DocumentRepository;
use Symfony\Component\HttpFoundation\File\File ;

/**
 * @Route("/document")
 */
class DocumentController extends AbstractController
{
    /**
     * @Route("/", name="app_document", methods={"GET"})
     */
    public function index(DocumentRepository $documentRepository)
    {
        return $this->render('document/index.html.twig', [
            'documents' => $documentRepository->findAll(),
        ]);
    }

        /**
     * @Route("/new", name="app_document_new")
     */
    public function addFiletAction(Request $request) {

        $document = new Document();
        $form = $this->createForm(DocumentType::class,$document);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $file = $form->get('file')->getData();
            $type = $form->get('type')->getData();
            $datecreation = $form->get('datecreation')->getData();
            $titre = $form->get('titre')->getData();
            $description = $form->get('description')->getData();
            $version = $form->get('version')->getData();
            $validation = $form->get('validation')->getData();
            $datevalidation = $form->get('datevalidation')->getData();
            $approbation = $form->get('approbation')->getData();
            $dateapprobation = $form->get('dateapprobation')->getData();
            $archivage = $form->get('archivage')->getData();
            $datearchivage = $form->get('datearchivage')->getData();
           
            $fileName = $file->getClientOriginalName();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $document->setFile($fileName);
            $document->setReference(uniqid());

            $document->setType($type);
            $document->setDatecreation($datecreation);
            $document->setTitre($titre);
            $document->setDescription($description);
            $document->setVersion($version);
            $document->setArchivage($archivage);
            $document->setValidation($validation);
            $document->setApprobation($approbation);
            $document->setCreateur($this->getUser());



            
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('app_document');
        }
    
        return $this->render("document/new.html.twig", array('form' => $form->createView()));
    }

     /**
     * @Route("/{id}", name="app_document_show", methods={"GET"})
     */
    public function show($id)
    {
        $em = $this->getDoctrine()->getManager();
       
        $repositoryDoc = $em->getRepository(Document::class);
        $repositoryCat = $em->getRepository(Categorie::class);
        
       

        $document = $repositoryDoc->find($id);
        $categorie = $repositoryCat->findBy(array('id' =>$document->getId()));
        
    

        return $this->render('document/show.html.twig', [
            'categorie' => $categorie,
            'document' => $document,
            
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_document_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Document $document, DocumentRepository $documentRepository)
    {
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $documentRepository->add($document);
            return $this->redirectToRoute('app_document', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('document/edit.html.twig', [
            'document' => $document,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete", name="delete_file")
     */
    public function deleteAction(Request $request, ManagerRegistry $doctrine) {
        $em = $doctrine->getManager();
        $repository = $em->getRepository(Document::class);
        $document = $repository->find($request->get('id'));
        $em->remove($document);
        $em->flush();
        return $this->redirect($this->generateUrl('app_document'));
    }
}
