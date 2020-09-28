<?php

namespace App\Form;

use App\Entity\Partner;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PartnerType extends ApplicationType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,$this->getConfiguration('Nom','Renseigner le nom du partenaire'))
            ->add('link',TextType::class,$this->getConfiguration('Lien','Renseigner le site web ou le mail du partenaire'))
            ->add('structure',ChoiceType::class,[
                'choices' => [
                    'Administration' =>'Administration',
                    'Collectivités'=>'Collectivités',
                    'Etablissements publics'=>'Etablissements publics',
                    'Associations'=>'Associations'
                ],])
            ->add('imageFile',FileType::class,['required'=>false])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
        ]);
    }
}
