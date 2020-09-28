<?php

namespace App\Form;

use App\Entity\Contact;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ContactType extends ApplicationType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname',TextType::class,$this->getConfiguration('Nom','Veuillez renseigner votre nom'))
            ->add('firstname',TextType::class,$this->getConfiguration('Prénom','Veuillez renseigner votre prénom'))
            ->add('email',EmailType::class,$this->getConfiguration('Email','Veuillez renseigner votre email'))
            ->add('tel',TextType::class,$this->getConfiguration('Téléphone','Veuillez renseigner votre numéro de téléphone'))
            ->add('nature_du_contact',ChoiceType::class,[
                'choices' => [
                    'Demande de contact' =>'Demande de contact',
                    'Demande de devis'=>'Demande de devis'
                ],])
            ->add('message',TextareaType::class,$this->getConfiguration('Message','Veuillez préciser l\'objet de votre demande'))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
