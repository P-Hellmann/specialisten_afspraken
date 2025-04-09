<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
            ])
            ->add('time', TimeType::class, [
                'label' => 'Time',
                'widget' => 'single_text',
            ])
            ->add('problems', TextType::class, [
                'label' => 'Problems',
            ])
            ->add('discussed', TextType::class, [
                'label' => 'Discussed',
            ])
            ->add('subject', TextType::class, [
                'label' => 'Subject',
            ])
            ->add('patient', EntityType::class, [
                'label' => 'Patient',
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->where('u.roles LIKE :roles')
                    ->setParameter('roles', '%PATIENT%');
                },
                'placeholder' => 'Select a patient',
                'required' => true,
                'choice_label' => function (User $user) {
                    return $user->getFirstName() . ' ' . $user->getLastName();
                },
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Make Appointment',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
            'patient_choices' => [],
            'specialist_choices' => [],
        ]);
    }
}
