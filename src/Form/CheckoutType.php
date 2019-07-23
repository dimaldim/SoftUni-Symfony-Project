<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'firstName',
                TextType::class,
                ['label' => false, 'attr' => ['class' => 'input', 'placeholder' => 'First Name']]
            )
            ->add(
                'lastName',
                TextType::class,
                ['label' => false, 'attr' => ['class' => 'input', 'placeholder' => 'Last Name']]
            )
            ->add(
                'email',
                EmailType::class,
                ['label' => false, 'attr' => ['class' => 'input', 'placeholder' => 'E-mail']]
            )
            ->add('city', TextType::class, ['label' => false, 'attr' => ['class' => 'input', 'placeholder' => 'City']])
            ->add(
                'country',
                TextType::class,
                ['label' => false, 'attr' => ['class' => 'input', 'placeholder' => 'Country']]
            )
            ->add(
                'address',
                TextType::class,
                ['label' => false, 'attr' => ['class' => 'input', 'placeholder' => 'Address']]
            )
            ->add(
                'telephone',
                TextType::class,
                ['label' => false, 'attr' => ['class' => 'input', 'placeholder' => 'Telephone']]
            )
            ->add(
                'notes',
                TextareaType::class,
                ['required' => false, 'label' => false, 'attr' => ['class' => 'input', 'placeholder' => 'Order Notes']]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Order::class,
            ]
        );
    }
}
