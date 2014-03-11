<?php
namespace Ens\SitesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Locale\Locale;

class PagesController extends Controller
{
	public function showAction($slug='accueil')
	{
		$em = $this->getDoctrine()->getManager();

	 if ($this->getRequest()->getLocale() == 'en')
	 {
	    $entity = $em->getRepository('EnsSitesBundle:Pages')->findOneBySlugEn($slug);
	 }
	 else if ($this->getRequest()->getLocale() == 'fr')
	 {
	 	$entity = $em->getRepository('EnsSitesBundle:Pages')->findOneBySlug($slug);
	 }
	 
	    if (!$entity) {
	        throw $this->createNotFoundException('La page demandée '.$slug.' est introuvable');
	    }
	 
	    return $this->render('EnsSitesBundle:Pages:show.html.twig', array(
	        'entity'      => $entity,
	 
	    ));
	}

	public function menuAction($page)
	{

     $em = $this->getDoctrine()->getManager();
	 
	    $entity = $em->getRepository('EnsSitesBundle:Pages')->getMenu();
	 
	    if (!$entity) {
	        throw $this->createNotFoundException('La page demandée est introuvable');
	    }
    return $this->render('EnsSitesBundle:Pages:menu.html.twig', array(
      'liste_articles' => $entity ,
      'page' => $page,
    ));
	}

}