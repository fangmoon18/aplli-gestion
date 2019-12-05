<?php

namespace App\Form;

use App\Entity\Candidat;
use App\Entity\Session;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CandidatManageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Nom', TextType::class,[
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"Nom"
          ]
        ])
        ->add('Prenom', TextType::class,[
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"Prénom"
          ]
        ])
        ->add('Email', EmailType::class,[
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"Email"
          ]
        ])
        ->add('NumTel', TelType::class,[
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"N° de téléphone"
          ]
        ])
        ->add('BirthDate', DateType::class,[
          'format'=>'yyyy-MM-dd',
          'widget' =>'single_text',
          'attr' => [
                  'class'=>'date-form input100'
          ]
        ])
        ->add('Etude', TextType::class,[
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"Niveau d'étude"
          ]
        ])
        ->add('StatutPro', TextType::class,[
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"Situation Professionnel"
          ]
        ])
        ->add('Inscription',DateType::class,[
          'format'=>'yyyy-MM-dd',
          'widget' =>'single_text',
          'attr' => [
                  'class'=>'date-form input100'
          ]
        ])
        ->add('TypeFinancement', TextType::class,[
          'required' => false,
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"Type de financement"
          ]
        ])
        ->add('StatutFinancement', ChoiceType::class,[
          'required' => false,
          'attr' => [
                  'class'=>'input100 select-form',
          ],
          'choices'=>[
              'Financé'=>'2',
              'En cours' =>'1',
              'Non financé' =>'0'
          ]
        ])
        ->add('FraisDossier', ChoiceType::class,[
          'choices'  => [
              'Payé' => true,
              'Non payé' => false
            ],
          'required' => false,
          'attr' => [
                  'class'=>'select-form input100'
          ]
        ])
        ->add('StatutTestApt', ChoiceType::class,[
          'choices'  => [
              'Non réalisé'=>null,
              'Validé' => "1",
              'Echoué' => "2"
            ],
          'required' => false,
          'attr' => [
                  'class'=>'select-form input100'
          ]
        ])
        ->add('IdentifiantPO', TextType::class,[
          'required' => false,
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"Identifiant"
          ]
        ])
        ->add('MdpPO', TextType::class,[
          'required' => false,
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"Mot de passe"
          ]
        ])
        ->add('EmailConseillePO', EmailType::class,[
          'required' => false,
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"Email Conseiller"
          ]
        ])
        ->add('NomStage', TextType::class,[
          'required' => false,
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"Nom de l'entreprise"
          ]
        ])
        ->add('CIRETStage', TextType::class,[
          'required' => false,
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"N° de CIRET"
          ]
        ])
        ->add('AdresseStage', TextType::class,[
          'required' => false,
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"Adresse"
          ]
        ])
        ->add('NumTelStage', TelType::class,[
          'required' => false,
          'attr' => [
                  'class'=>'input100',
                  'placeholder' =>"N° de téléphone"
          ]
        ])
        ->add('Note', TextareaType::class,[
          'required' => false,
          'attr' => [
                  'class'=>'input100'
          ]
        ])
        //Créer un select avec un objet
        ->add('SessionFait', EntityType::class,[
          //Indiquer quel objet utiliser
          'class' =>Session::class,
          //Indiquer quel attribut de l'objet utiliser
          'choice_label' => 'Titre',
          'attr' => [
                  'class'=>'input100 select-form']
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
