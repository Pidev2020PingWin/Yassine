<?php


namespace UserBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('categorie', EntityType::class, array('class'=>'UserBundle:Categorie','choice_label'=>'nom','multiple'=>false))
            ->add('file')
            ->add('description')
            ->add('prix')
            ->add('Envoyer',      SubmitType::class)


        ;
    }
}

