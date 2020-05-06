<?php
namespace App\Form\Location\Country;

use App\Entity\Location\Airport;
use App\Entity\Location\City;
use App\Entity\Location\Country;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('code')
            ->add('cities', EntityType::class, [
                'class' => City::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('airports', EntityType::class, [
                'class' => Airport::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('template', CountryTemplateFormType::class, [
            'data_class' => Country::class,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
        ]);
    }
}