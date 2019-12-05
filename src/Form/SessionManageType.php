<?php

namespace App\Form;

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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SessionManageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
              ->add('titre', TextType::class,[
                'attr' => [
                        'class'=>'input100'
                ]
              ])
              ->add('DebutFormation', DateType::class, [
                  'format'=>'yyyy-MM-dd',
                  'widget' =>'single_text',
                  'attr' => [
                          'class'=>'date-form input100'
                  ]
              ])
              ->add('FinFormation', DateType::class, [
                  'format'=>'yyyy-MM-dd',
                  'widget' =>'single_text',
                  'attr' => [
                          'class'=>'date-form input100'
                  ]
              ])
              ->add('DebutExam', DateType::class, [
                  'format'=>'yyyy-MM-dd',
                  'widget' =>'single_text',
                  'required' => false,
                  'attr' => [
                          'class'=>'date-form input100'
                  ]
              ])
              ->add('FinExam', DateType::class, [
                  'format'=>'yyyy-MM-dd',
                  'widget' =>'single_text',
                  'required' => false,
                  'attr' => [
                          'class'=>'date-form input100'
                  ]
              ])
              ->add('DebutStage', DateType::class, [
                  'format'=>'yyyy-MM-dd',
                  'widget' =>'single_text',
                  'required' => false,
                  'attr' => [
                          'class'=>'date-form input100'
                  ]
              ])
              ->add('FinStage', DateType::class, [
                  'format'=>'yyyy-MM-dd',
                  'widget' =>'single_text',
                  'required' => false,
                  'attr' => [
                          'class'=>'date-form input100'
                  ]
              ])

;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
