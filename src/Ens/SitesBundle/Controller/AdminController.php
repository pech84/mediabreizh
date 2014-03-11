<?php
//test2
namespace Ens\SitesBundle\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ens\SitesBundle\Entity\Pages;
use Ens\SitesBundle\Entity\User;
use Ens\SitesBundle\Entity\Contact;
use Ens\SitesBundle\Form\PagesType;
use Ens\SitesBundle\Form\UserType;


class AdminController extends Controller
{
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();
	 
	    $entity = $em->getRepository('EnsSitesBundle:Pages')->findAll();
	 
	    if (!$entity) {
	        throw $this->createNotFoundException('La page demandée est introuvable');
	    }
	 
	    return $this->render('EnsSitesBundle:Admin:index.html.twig', array(
	        'entity'      => $entity,
	 
	    ));
	}

	public function createAction()
	{
		$entity  = new Pages();
		  $entity->setMenu(false);
	  	$request = $this->getRequest();
	  	$form    = $this->createForm(new PagesType(), $entity);
	  	$form->bind($request);
	 	
	 	if ($form->isValid()) {
	 	   $em = $this->getDoctrine()->getEntityManager();
	 	
	 	   $em->persist($entity);
	 	   $em->flush();
	 	
	 	   return $this->redirect($this->generateUrl('ens_admin_preview', array(
	 	     'title' => $entity->getTitle(),
	 	     //'content' => $entity->getContent(),
	 	     'id' => $entity->getId()

	 	   )));
	 	 }
	 	
	 	 return $this->render('EnsSitesBundle:Admin:new.html.twig', array(
	 	   'entity' => $entity,
	 	   'form'   => $form->createView()
	 	 ));
	}
   

    public function newAction()
    {
        $entity = new Pages();
        $form   = $this->createForm(new PagesType(), $entity);

        return $this->render('EnsSitesBundle:Admin:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


	public function editAction($id)
	{
		$em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnsSitesBundle:Pages')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }


        $editForm = $this->createForm(new PagesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EnsSitesBundle:Admin:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));

	}


	public function updateAction($id)
    {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('EnsSitesBundle:Pages')->find($id);

      if (!$entity) {
          throw $this->createNotFoundException('Unable to find pages entity.');
      }

      $editForm   = $this->createForm(new PagesType(), $entity);
      $deleteForm = $this->createDeleteForm($id);

      $request = $this->getRequest();

      $editForm->bind($request);

      if ($editForm->isValid()) {
          $em->persist($entity);
          $em->flush();

          return $this->redirect($this->generateUrl('ens_admin_preview', array(
              'title' => $entity->getTitle(),
             // 'content' => $entity->getContent(),
              'id' => $entity->getId()
          )));
      }

      return $this->render('EnsSitesBundle:Admin:edit.html.twig', array(
          'entity'      => $entity,
          'edit_form'   => $editForm->createView(),
          'delete_form' => $deleteForm->createView(),
      ));
    }

	private function createDeleteForm($id)
    {
      return $this->createFormBuilder(array('id' => $id))
                  ->add('id', 'hidden')
                  ->getForm()
                ;
    }

    public function deleteAction($id)
    {
      $form = $this->createDeleteForm($id);
      $request = $this->getRequest();
     
      $form->bind($request);
     
      //if ($form->isValid()) {
        $em = $this->getDoctrine()->getEntityManager();
        $pages = $em->getRepository('EnsSitesBundle:Pages')->find($id);
     
        if (!$pages) {
          throw $this->createNotFoundException('Unable to find Pages pages.');
        }
     
        $em->remove($pages);
        $em->flush();
     // }
     
      return $this->redirect($this->generateUrl('ens_admin_index'));
    }

    public function previewAction($id)
    {
      $em = $this->getDoctrine()->getManager();
     
      $entity = $em->getRepository('EnsSitesBundle:Pages')->find($id);
     
      if (!$entity) {
        throw $this->createNotFoundException('Unable to find Pages entity.');
      }
     
      $deleteForm = $this->createDeleteForm($entity->getId());
      return $this->render('EnsSitesBundle:Pages:preview.html.twig', array(
        'entity'      => $entity,
        'delete_form' => $deleteForm->createView(),
      ));
    }

    public function contactAction()
    {
      $em = $this->getDoctrine()->getManager();
     
      $contacts = $em->getRepository('EnsSitesBundle:Contact')->findAll();
     
      if (!$contacts) {
        throw $this->createNotFoundException('Unable to find Contact contacts.');
      }
     
      return $this->render('EnsSitesBundle:Contact:index.html.twig', array(
        'contacts'      => $contacts,
      ));
    }

    public function publishAction($id)
    {
      $form = $this->createPublishForm($id);
      $request = $this->getRequest();
     
      $form->bind($request);

      //if ($form->isValid()) 
     // {
        $em = $this->getDoctrine()->getManager();
     
        $entity = $em->getRepository('EnsSitesBundle:Pages')->find($id);


        if (!$entity) {
          throw $this->createNotFoundException('Unable to find Pages entity.');
        }
      
        if ($entity->getMenu())
        {
          $entity->setMenu(false);
        }
        else
        {
          $entity->setMenu(true);
        }

        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('ens_admin_index'));
     //}
    }

    private function createPublishForm($id)
    {
      return $this->createFormBuilder(array('id' => $id))
                  ->add('id', 'hidden')
                  ->getForm()
                ;
    }

    public function mdpAction($id)
    {    
      $em = $this->getDoctrine()->getManager();

      $user = $em->getRepository('EnsSitesBundle:User')->find($id);



      if (!$user) {
          throw $this->createNotFoundException('Unable to find pages entity.');
      }


      $request = $this->getRequest();

      
      $mdpForm   = $this->createForm(new UserType(), $user);

      $mdpForm->bind($request);


      if ($mdpForm->isValid()) {
          
          $factory = $this->get('security.encoder_factory');
          $encoder = $factory->getEncoder($user);
          $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
          $user->setPassword($password);
          
          $em->persist($user);
          $em->flush();

          return $this->redirect($this->generateUrl('ens_admin_index', array(
          )));
      }

      return $this->render('EnsSitesBundle:Admin:mdp.html.twig', array(
          'user'      => $user,
          'mdp_form'   => $mdpForm->createView(),
      ));
    }

}