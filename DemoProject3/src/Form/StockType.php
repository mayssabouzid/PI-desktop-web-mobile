<?php

namespace App\Form;

use App\Entity\Stock2;
use App\Entity\Partenaires;
use App\Entity\Stock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class StockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('noms', TextType::class, [
                'constraints'=> new NotBlank]
            )
            
            ->add('refs' )
            ->add('categories', ChoiceType::class, [
                        'choices'  => [
                            'Alimentaire' => 'Alimentaire',
                    'Equipement' => 'Equipement',
                    'Sécurite' => 'Sécurite'
                        ],
                        'constraints'=> new NotBlank,
                        'placeholder' => 'select your categorie'
                        ])
            ->add('qtes' )
           
           
            ->add('partenaire' ,EntityType::class ,[
                'class' => Partenaires::class ,
                'choice_label' =>'nomMarquep' , 
                'placeholder' => 'select your Partenaire',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stock::class,
        ]);
    }
}