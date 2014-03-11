<?php
// src/Ens/JobeetBundle/Form/ContactType.php
 
namespace Ens\SitesBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;	
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ens\SitesBundle\Entity\Contact;
 
class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prenom', null, array('label' => 'contact.prenom'));
        $builder->add('nom', null, array('label' => 'contact.nom'));
        $builder->add('commune', null, array('label' => 'contact.commune'));
        $builder->add('entreprise', null, array('label' => 'contact.entreprise'));
        $builder->add('mail', null, array('label' => 'contact.email'));
        $builder->add('tel', null, array('label' => 'contact.tel'));
        $builder->add('titre', null, array('label' => 'contact.titre'));
        //ajout form fichier
        $builder->add('contenu', null, array('label' => 'contact.message', 'attr' => array('rows' => '10')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ens\SitesBundle\Entity\Contact'
        ));
    }

 
    public function getName()
    {
        return 'ens_contacttype';
    }
}