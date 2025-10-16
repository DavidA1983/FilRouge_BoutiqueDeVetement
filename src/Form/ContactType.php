<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Votre nom',
                'attr' => [
            'required' => true,
            'oninvalid' => "this.setCustomValidity('Veuillez entrer votre nom')",
            'oninput' => "this.setCustomValidity('')"],
            ])

            ->add('prenom', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
            'required' => true,
            'oninvalid' => "this.setCustomValidity('Veuillez entrer votre prénom')",
            'oninput' => "this.setCustomValidity('')"],
            ])

            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                 'attr' => [
                'required' => true,
            'oninvalid' => "this.setCustomValidity('Veuillez entrer une adresse email valide')",
            'oninput' => "this.setCustomValidity('')"],
            ])

            ->add('sujet', TextType::class, [
                'label' => 'Sujet',
                'attr' => [
                'required' => true,
                'oninvalid' => "this.setCustomValidity('Veuillez entrer le sujet de votre message')",
                'oninput' => "this.setCustomValidity('')"],
            ])

            ->add('message', TextareaType::class, [
                'label' => 'Message',
                 'attr' => [
                'required' => true,
            'oninvalid' => "this.setCustomValidity('Veuillez entrer un message')",
            'oninput' => "this.setCustomValidity('')"],
            ])

            ->add('envoyer', SubmitType::class, [
                'label' => 'Envoyer'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}