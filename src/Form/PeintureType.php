<?php

namespace App\Form;

use App\Entity\Peinture;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeintureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('largeur')
            ->add('hauteur')
            ->add('enVente')
            ->add('prix')
            ->add('dateRealisation')
            ->add('createdAt')
            ->add('description', TextareaType::class)
            ->add('portfolio')
            ->add('slug')
            ->add('file')
            ->add('photo')
            ->add('user', null, ['choice_label' => 'title'])
            ->add('categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Peinture::class,
        ]);
    }
}
