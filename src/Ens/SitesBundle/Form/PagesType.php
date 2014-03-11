<?php
// src/Ens/JobeetBundle/Form/JobType.php
 
namespace Ens\SitesBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;	
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ens\SitesBundle\Entity\Pages;
 
class PagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', null, array('label' => 'titre'));
        $builder->add('titleEn', null, array('label' => 'titre anglais'));
        $builder->add('content', 'tiny');
        $builder->add('contentEn', 'tini');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ens\SitesBundle\Entity\Pages'
        ));
    }

 
    public function getName()
    {
        return 'ens_pagestype';
    }
}