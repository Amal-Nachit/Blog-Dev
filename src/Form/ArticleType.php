<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\categorie;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('thumbnailFile', FileType::class, [
                'label' => 'Image du produit :'
            ])
            ->add('text')
            ->add('categorie', EntityType::class, [
                'class' => categorie::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'setCreatedAt'])
        ;
    }

    public function setCreatedAt(PreSubmitEvent $event)
    {
        $data = $event->getData();
        if (empty($data['createdAt'])) {
            $data['createdAt'] = (new \DateTime())->format('d-m-Y H:i');
            $event->setData($data);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
