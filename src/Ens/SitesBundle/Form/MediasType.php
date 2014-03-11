<?php
// src/Ens/JobeetBundle/Form/MediasType.php
 
namespace Ens\SitesBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;	
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ens\SitesBundle\Entity\Medias;
 
class MediasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', 'file', array('label' => 'Image', 'required' => true));
        $builder->add('name', null, array('label' => 'Titre'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ens\SitesBundle\Entity\Medias'
        ));
    }

 
    public function getName()
    {
        return 'ens_mediastype';
    }
}