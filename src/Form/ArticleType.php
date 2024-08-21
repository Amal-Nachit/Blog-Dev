<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\categorie;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('image')
            ->add('text')
            ->add('status')
            ->add('articleCategorie', EntityType::class, [
                'class' => categorie::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('creator', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
