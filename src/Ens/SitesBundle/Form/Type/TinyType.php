<?php
// src/Sdz/BlogBundle/Form/Type/CkeditorType.php
 
namespace Ens\SitesBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
 
class TinyType extends AbstractType
{
  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'attr' => array('class' => 'input-xxlarge tiny'),

    ));
  }
 
  public function getParent()
  {
    return 'textarea';
  }
 
  public function getName()
  {

    return 'tiny';
  }
}

