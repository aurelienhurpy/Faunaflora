<?php

namespace App\Form;

use App\Entity\Team;
use App\Form\ImageType;
use App\Form\TeamType;
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

class TeamType extends ApplicationType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextareaType::class,$this->getConfiguration('Nom','Insérer un nom'))
            ->add('lastname',TextareaType::class,$this->getConfiguration('Prénom','Insérer un prénom'))
            ->add('title',TextareaType::class,$this->getConfiguration('titre','Insérer un titre/une fonction'))
            ->add('bio',TextareaType::class,$this->getConfiguration('Bio','Insérer une bio'))
            ->add('imageFile',FileType::class,['required'=>false])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
