<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Cpu;
use App\Entity\CpuProduction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class LigneProductionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('productionTime')
            ->add('cpu', EntityType::class, [
                'class' => Cpu::class,
                'choice_label' => 'id',  // Propriété de l'entité Cpu à afficher dans le champ de sélection
            ]) // Ajoutez ici les autres champs de l'entité LigneProduction
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CpuProduction::class,
        ]);
    }
}
