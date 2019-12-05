<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\FileUploader;
use App\Form\SessionManageType;
use App\Form\CandidatManageType;
use App\Form\UploadFileType;
use App\Form\RegisterFormType;
use App\Entity\Session;
use App\Entity\Candidat;
use App\Entity\Document;
use App\Entity\User;
use App\Repository\SessionRepository;
use App\Repository\CandidatRepository;
use App\Repository\DocumentRepository;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

// A effacer une fois le compte créer
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class GestionController extends AbstractController
{

    /**
     * @Route("/", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils){

        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('gestion/index.html.twig', array(
            'error'=>$error

        ));
    }

    //Système d'inscription
    /**
     * @Route("/gestion/inscription", name="inscription")
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder){

        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(User::class)->findAll();
        dump($users);

        $user = new User();
        $form = $this->createForm(RegisterFormType::class, $user);
        $form->HandleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user->setPassword(
            //Encode le mot de passe en le récupérant du formulaire d'inscription
                $passwordEncoder->encodePassword($user, $form->get('password')->getData())
            );
            $user->setUsername($form->get('username')->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }


        return $this->render('gestion/inscription.html.twig', [
            'formUser'=>$form->createView()
        ]);
    }

    /**
     * @Route("/gestion", name="home")
     */
    public function index(){
      $repo = $this->getDoctrine()->getRepository(Session::class);
      $sessions = $repo->findAll();
        return $this->render('gestion/home.html.twig', [
            'title'=>"Gestion Sessions",
            'sessions'=>$sessions
        ]);
    }

    /**
     * @Route("/gestion/session/new-session", name="session_create")
     *Je met deux routes, une pour créer et une pour modifier
     * @Route("/session/{id}/edit", name="session_edit")
     */
    public function sessionManage(Session $session= null, Request $request,ObjectManager $manager){

      //Si je n'ai pas d'id alors il créer une nouvelle session
      if(!$session){
        //Je crée un objet vierge de mon objet $Session
        $session = new Session();
      }
      //Je crée un formulaire pour la création et la modification de mes objets $Session comportant notament tout les champs requis
      $form = $this->createForm(SessionManageType::class, $session);

        //La requete est un POST alors elle est lu par mon manager
        $form ->handleRequest($request);
        //Si mon formulaire est valide et est en traitement
        //Alors le manager prépare la requete puis l'execute
        if($form->isSubmitted()&& $form->isValid()){
          $manager->persist($session);
          $manager->flush();

          //Un fois la session créée, j'affiche un message d'information pour le dire à mon utilisateur
          $this->addFlash('success','La session a été créée avec succès !');

          //Une fois tout cela fait, tu me redirige sur la page de la session créée
          return $this->redirectToRoute('session_show',['id' => $session->getId()]);
        }

        return $this->render('gestion/new-session.html.twig', [
          //Donner à twig le résultat de la méthode d'affichage du formulaire uniquement
            'formSession' =>$form->createView(),
            'title'=>"Création d'une Session",
            //Si la session a déjà une id alors nous sommes en editMode
            'editMode' =>$session->getId() !== null
        ]);
    }

    /**
     * @Route("/gestion/session/{id}", name="session_show")
     */
    public function sessionShow($id){
      $repo = $this->getDoctrine()->getRepository(Session::class);
      $session = $repo ->find($id);
        return $this->render('gestion/session_show.html.twig', [
            'session' => $session,
        ]);
    }

    /**
     * @Route("/gestion/session/delete/{id}", name="session_delete")
     */
    public function sessionDelete($id, ObjectManager $manager){
      $repo = $this->getDoctrine()->getRepository(Session::class);
      $session = $repo ->find($id);
      $manager->remove($session);
      $manager->flush();

      //Un fois la session supprimée, j'affiche un message d'information pour le dire à mon utilisateur
      $this->addFlash('success','La session a été supprimée avec succès !');

      //Une fois tout cela fait, tu me redirige sur la page de la session créée
      return $this->redirectToRoute('home');

    }

    /**
     * @Route("/gestion/candidat/new", name="candidat_create")
     *@Route("/gestion/candidat/{id}/edit", name="candidat_edit")
     */
    public function candidatManage(Candidat $candidat=null, Request $request,ObjectManager $manager){

      //Si je n'ai pas d'id alors il créer une nouveau candidat
      if(!$candidat){
        //Je crée un objet vierge de mon objet $Candidat
        $candidat = new Candidat();
      }
        //Je crée un formulaire pour la création et la modification de mes objets $Session comportant notament tout les champs requis
        $form = $this->createForm(CandidatManageType::class, $candidat);

        //La requete est un POST alors elle est lu par mon manager
        $form ->handleRequest($request);
        //Si mon formulaire est valide et est en traitement
        //Alors le manager prépare la requete puis l'execute
        if($form->isSubmitted()&& $form->isValid()){
          $manager->persist($candidat);
          $manager->flush();

          //Un fois la candidat créée, j'affiche un message d'information pour le dire à mon utilisateur
          $this->addFlash('success','Le candidat a été enregistré avec succès !');
          //Une fois tout cela fait, tu me redirige sur la page du candidat créée
          return $this->redirectToRoute('candidat_show',['id' => $candidat->getId()]);
        }

        return $this->render('gestion/new_candidat.html.twig', [
          //Donner à twig le résultat de la méthode d'affichage du formulaire uniquement
            'formCandidat' =>$form->createView(),
            'title'=>"Nouveau candidat",
            //Si le candidat a déjà une id alors nous sommes en editMode
            'editMode' =>$candidat->getId() !== null,
            'candidat'=>$candidat
        ]);
    }


    /**
     * @Route("/gestion/candidat/{id}", name="candidat_show")
     */
    public function candidatShow($id){
      //Je chrge à la fois le candidat ayant l'id $id et les documents relatifs à cette personne
      $repo = $this->getDoctrine()->getRepository(Candidat::class);
      $repo2 = $this->getDoctrine()->getRepository(Document::class);
      $candidat = $repo-> find($id);
      $document = $repo2 ->findBy(['Candidat'=>$id]);
        return $this->render('gestion/candidat_show.html.twig', [
            'candidat' => $candidat,
            'documents' =>$document
        ]);
    }

    /**
     * @Route("/gestion/candidat/delete/{id}", name="candidat_delete")
     */
    public function candidatDelete($id, ObjectManager $manager){
      $repo = $this->getDoctrine()->getRepository(Candidat::class);
      $candidat = $repo ->find($id);
      $manager->remove($candidat);
      $manager->flush();

      //Un fois le candidat supprimé, j'affiche un message d'information pour le dire à mon utilisateur
      $this->addFlash('success','Le candidat a été supprimé avec succès !');

      //Une fois tout cela fait, tu me redirige sur la page de la session créée
      return $this->redirectToRoute('home');

    }

    /**
    *@Route("/gestion/upload/{id}", name="document_upload")
    */
    public function candidatUpload($id, Request $request, ObjectManager $manager, FileUploader $fileUploader){
      $document = new Document();
      $repo = $this->getDoctrine()->getRepository(Candidat::class);
      $candidat = $repo ->find($id);
      $session = $candidat->getSessionFait()->getId();
      //Je crée un formulaire pour l'upload de document d'un candidat
      $form = $this->createForm(UploadFileType::class, $document);

      //La requete est un POST alors elle est lu par mon manager
      $form ->handleRequest($request);
      //Si mon formulaire est valide et est en traitement
      //Alors la fonction d'upload est appelé pour stocker le PDF
      if ($form->isSubmitted() && $form->isValid()) {
        //Je récupère le fichier et je génére un nom automatique afin de ne pas avoir de soucis
          $file = $document->getFichier();
          $fileName = $fileUploader->upload($file);
          //J'associe le nouveau nom du fichier à l'attribut fichier
          $document->setFichier($fileName);
          //Lie le fichier au candidat choisis au préalable
          $document->setCandidat($candidat);

          //Enregistre le document sur la BDD
          $manager->persist($document);
          $manager->flush();

          //Un fois le document créé, j'affiche un message d'information pour le dire à mon utilisateur
          $this->addFlash('success','Le fichier a été enregistré avec succès !');
          // ... persist the $product variable or any other work
          return $this->redirectToRoute('session_show', ['id' =>$session]);
        }

        return $this->render('gestion/uploadfile.html.twig', [
             'formDocument' => $form->createView(),
             'candidat'=> $candidat
         ]);
      }

      /**
       * @Route("/gestion/document/delete/{id}", name="document_delete")
       */
      public function documentDelete($id, ObjectManager $manager){
        $repo = $this->getDoctrine()->getRepository(Document::class);
        $document = $repo->find($id);
        //Je récupere l'id du candidat pour la redirection de fin seulement
        $candidat = $document->getCandidat(['id']);
        $candidatID=$candidat->getId();

        //Je supprime l'entrée dans la BDD
        $manager->remove($document);
        $manager->flush();

        //Un fois le candidat supprimé, j'affiche un message d'information pour le dire à mon utilisateur
        $this->addFlash('success','Le fichier a été supprimé avec succès !');

        //Une fois tout cela fait, tu me redirige sur la page de la session créée
        return $this->redirectToRoute('candidat_show', [
          'id' =>$candidatID
        ]);

      }
    /*Liste toute les sessions existantes dans le header*/
    public function sessionList(){
      $repo = $this->getDoctrine()->getRepository(Session::class);
      //Je charge toute les sessions existantes
      $sessions = $repo->findAll();
        return $this->render(
          /*On l'affiche sur un template à part pour éviter des erreurs en changeant de page*/
          /*La page sera appelé sur celle de base ensuite*/
                'gestion/session_list.html.twig',
                ['sessions' => $sessions]);
    }
    /**
    *@Route("/gestion/email_one/{id}", name="send_mail_one")
    */
    /*Cette fonction permet de renvoyer sur la page de gmail et de préremplir le champs destinataire */
    public function emailOne($id){
        $repo = $this->getDoctrine()->getRepository(Candidat::class);
        $candidat = $repo->find($id);
        $email =$candidat->getEmail();
    }

}
