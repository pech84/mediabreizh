<?php
// src/Ens/SitesBundle/DataFixtures/ORM/LoadJobData.php
namespace Ens\SitesBundle\DataFixtures\ORM;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ens\SitesBundle\Entity\Pages;
 
class LoadPagesData extends AbstractFixture implements OrderedFixtureInterface
{
  public function load(ObjectManager $em)
  {
    $accueil = new Pages();
    $accueil->setTitle('Accueil');
    $accueil->setMenu(true);
    $accueil->setContent('Binevenue sur la page d\'accueil');
 
    $em->persist($accueil);
 
    $em->flush();
  }
 
  public function getOrder()
  {
    return 1; // the order in which fixtures will be loaded
  }
}