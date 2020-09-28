<?php

namespace App\Form;

use App\Entity\Intro;
use App\Form\ImageType;
use App\Form\IntroType;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class IntroType extends ApplicationType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content',TextareaType::class,$this->getConfiguration('Paragraphe 1','Insérer un contenu'))
            ->add('contentb',TextareaType::class,$this->getConfiguration('Paragraphe 2','Insérer un contenu'))
            ->add('contentc',TextareaType::class,$this->getConfiguration('Paragraphe 3','Insérer un contenu'))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Intro::class,
        ]);
    }
}
