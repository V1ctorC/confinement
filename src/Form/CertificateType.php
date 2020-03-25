<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CertificateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('birthdate', BirthdayType::class)
            ->add('birthplace', TextType::class)
            ->add('address', TextType::class)
            ->add('zipcode', NumberType::class)
            ->add('city', TextType::class)
            ->add('reason', ChoiceType::class, [
                'label'         => 'Quelle est la raison du déplacement ?',
                'required'      => true,
                'expanded'      => true,
                'multiple'      => false,
                'choices'       => [
                    'Déplacements entre le domicile et le lieu d’exercice de l’activité professionnelle, lorsqu’ils sont
                     indispensables à l’exercice d’activités ne pouvant être organisées sous forme de télétravail ou 
                     déplacements professionnels ne pouvant être différés.' => 1,
                    'Déplacements pour effectuer des achats de fournitures nécessaires à l’activité professionnelle et 
                    des achats de première nécessité dans des établissements dont les activités demeurent autorisées 
                    (liste sur gouvernement.fr)' => 2,
                    'Consultations et soins ne pouvant être assurés à distance et ne pouvant être différés ; 
                    consultations et soins des patients atteints d\'une affection de longue durée.' => 3,
                    'Déplacements pour motif familial impérieux, pour l’assistance aux personnes vulnérables ou la 
                    garde d’enfants.' => 4,
                    'Déplacements brefs, dans la limite d\'une heure quotidienne et dans un rayon maximal d\'un kilomètre
                     autour du domicile, liés soit à l\'activité physique individuelle des personnes, à l\'exclusion de 
                     toute pratique sportive collective et de toute proximité avec d\'autres personnes, soit à la 
                     promenade avec les seules personnes regroupées dans un même domicile, soit aux besoins des 
                     animaux de compagnie.' => 5,
                    'Convocation judiciaire ou administrative.' => 6,
                    'Participation à des missions d’intérêt général sur demande de l’autorité administrative.' => 7
                ]
            ])
            ->add('approveCity', TextType::class)
            ->add('approveDate', DateTimeType::class)
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
