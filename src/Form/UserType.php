<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userName', TextType::class,[
                "attr" => [
                    "class" => "nom"
                ]
            ])
            ->add('userSurname', TextType::class,[
                "attr" =>[
                    "class" => "prenom",
                    "required" => "false"
                ]
            ])
            ->add('userEmail', EmailType::class,[
                "attr" =>[
                    "class" => "email"
                ]
            ])
            ->add('userDate' ,DateType::class,[
                "attr" =>[
                    "class" => "ddn",
                    "required" => "false"
                ]
            ])
            ->add('userSexe', RadioType::class,[
                "attr" =>[
                    "class" => "m"
                ]
            ])
            ->add('userSexe', RadioType::class,[
                "attr" =>[
                    "class" => "f"
                ]
            ])
            ->add('userPassword', PasswordType::class,[
                "attr" =>[
                    "class" => "mdp"
                ]
            ])
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
