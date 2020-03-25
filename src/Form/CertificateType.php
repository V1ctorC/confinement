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
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CertificateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'required'      => true,
                'label'         => 'Prénom',
                'constraints'   => [
                    new NotBlank(),
                    new Length(['min' => 3,
                                'minMessage' => "Il faut minimum 3 caractères",
                                'max' => 30,
                                'maxMessage' => "Il ne faut pas dépasser 30 caractères"]),
                    new Type(['type' => "string"])
                ]
            ])

            ->add('lastname', TextType::class, [
                'required'      => true,
                'label'         => 'Nom',
                'constraints'   => [
                    new NotBlank(),
                    new Length(['min' => 3,
                        'minMessage' => "Il faut minimum 3 caractères",
                        'max' => 30,
                        'maxMessage' => "Il ne faut pas dépasser 30 caractères"]),
                    new Type(['type' => "string"])
                ]
            ])

            ->add('birthdate', BirthdayType::class, [
                'required'      => true,
                'label'         => 'Date de naissance',
                'format' => 'dd MM yyyy',
                'constraints'   => [
                    new NotBlank(),
                    new LessThan("today")
                ]
            ])

            ->add('birthplace', TextType::class, [
                'required'      => true,
                'label'         => 'Lieu de naissance',
                'constraints'   => [
                    new NotBlank(),
                    new Length(['min' => 3,
                        'minMessage' => "Il faut minimum 3 caractères",
                        'max' => 30,
                        'maxMessage' => "Il ne faut pas dépasser 50 caractères"]),
                    new Type(['type' => "string"])
                ]
            ])

            ->add('address', TextType::class, [
                'required'      => true,
                'label'         => 'Adresse',
                'constraints'   => [
                    new NotBlank(),
                    new Length(['min' => 8,
                        'minMessage' => "Il faut minimum 8 caractères",
                        'max' => 256,
                        'maxMessage' => "Il ne faut pas dépasser 256 caractères"]),
                    new Type(['type' => "string"])
                ]
            ])

            ->add('zipcode', NumberType::class, [
                'required'      => true,
                'label'         => 'Code postal',
                'constraints'   => [
                    new NotBlank(),
                    new Length(['min' => 5,
                        'minMessage' => "Le code postal doit comporter 5 caractères",
                        'max' => 5,
                        'maxMessage' => "Le code postal doit comporter 5 caractères"]),
                    new Type(['type' => "numeric"])
                ]
            ])

            ->add('city', TextType::class, [
                'required'      => true,
                'label'         => 'Ville',
                'constraints'   => [
                    new NotBlank(),
                    new Length(['min' => 3,
                        'minMessage' => "Il faut minimum 3 caractères",
                        'max' => 30,
                        'maxMessage' => "Il ne faut pas dépasser 50 caractères"]),
                    new Type(['type' => "string"])
                ]
            ])

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

            ->add('approveCity', TextType::class, [
                'required'      => true,
                'label'         => 'Fait à',
                'constraints'   => [
                    new NotBlank(),
                    new Length(['min' => 3,
                        'minMessage' => "Il faut minimum 3 caractères",
                        'max' => 30,
                        'maxMessage' => "Il ne faut pas dépasser 50 caractères"]),
                    new Type(['type' => "string"])
                ]
            ])

            ->add('approveDate', DateTimeType::class, [
                'required'      => true,
                'label'         => 'Le',
                'html5'         => false,
                'format' => 'dd MM yyyy H:i',
                'constraints'   => [
                    new NotBlank(),
                    new GreaterThanOrEqual('today')
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Générer le PDF'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
