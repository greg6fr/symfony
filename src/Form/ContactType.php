<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject',TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'The subject is required',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Your subject is too short, please enter minimum 2 characters...',
                        'maxMessage' => 'Your subject is too long, please enter maximum 255 characters...',
                    ])
                ],
            ])
            ->add('email',EmailType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Your email address is required',
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 120,
                        'minMessage' => 'Your email address is too short, please enter minimum 5 characters...',
                        'maxMessage' => 'Your email address  is too long, please enter maximum 120 charaters...',
                    ])
                ]])
            ->add('message',TextareaType::class,[
                'constraints' => [

                    new NotBlank([
                        'message' => 'Your description is required',
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 255,
                        'minMessage' => 'Your message is too short, please enter minimum 5 characters...',
                        'maxMessage' => 'Your message is too long, please enter maximum 255 charcaters...',
                    ])
                ]])
            ->add('Send', SubmitType::class,['label' => 'Send'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
