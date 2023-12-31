<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                    ],
                ],
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Proszę, wprowadzić hasło',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Twoje hasło, powinno mieć co najmniej {{ limit }} znaków',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => 'Nowe hasło',
                    'label_attr' => ['class'=> 'form-label'],
                    'attr' => ['class'=> 'form-control border bg-light'],
                ],
                'second_options' => [
                    'label' => 'Powtórz hasło',
                    'label_attr' => ['class'=> 'form-label'],
                    'attr' => ['class'=> 'form-control border bg-light'],
                ],
                'invalid_message' => 'Pola hasła muszą się zgadzać.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
