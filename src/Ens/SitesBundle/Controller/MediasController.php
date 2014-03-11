<?php
namespace Ens\SitesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ens\SitesBundle\Entity\Medias;
use Ens\SitesBundle\Form\MediasType;

class MediasController extends Controller
{
	public function indexAction($postId)
		{
		$entity  = new Medias();
		$entity->setPostId($postId);
		$entity->setType('img');
	  	$request = $this->getRequest();
	  	$form    = $this->createForm(new MediasType(), $entity);
	  	$form->bind($request);
	 	
	 	$em = $this->getDoctrine()->getManager();
	 
	    $entity_list = $em->getRepository('EnsSitesBundle:Medias')->findByPost_id($postId);	
	 	
	 	if ($form->isValid()) {
	 	
	 	   	$em->persist($entity);
	 	   	$em->flush();


	 	   		    /*ajouter flash message envoyer et envoyer mail */
			    $this->get('session')->getFlashBag()->add(
		            'notice',
		            'image '.$entity->getPostId().' ajouté'
		        );

		        return $this->render('EnsSitesBundle:Medias:index.html.twig', array(
			        'entity' => $entity,
			        'entity_list' => $entity_list,
			        'form'   => $form->createView()
	        	));
	 	
	 	 }
		

	
		return $this->render('EnsSitesBundle:Medias:index.html.twig', array(
	        'entity' => $entity,
	        'entity_list' => $entity_list,

	 	   'form'   => $form->createView()
	 
	    ));
	}

	

}