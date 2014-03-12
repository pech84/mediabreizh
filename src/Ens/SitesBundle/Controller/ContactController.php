<?php
namespace Ens\SitesBundle\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ens\SitesBundle\Entity\Contact;
use Ens\SitesBundle\Form\ContactType;
//require_once 'lib/swift_required.php';

class ContactController extends Controller
{
	public function createAction()
	{
	  $contact  = new Contact();
	  $request = $this->getRequest();
	  $form    = $this->createForm(new ContactType(), $contact);
	  $form->bind($request);
	 
	  if ($form->isValid()) {
	    $em = $this->getDoctrine()->getManager();
	 
	    $em->persist($contact);
	    $em->flush();

	    // Create the message
		$message = \Swift_Message::newInstance()

		// Give the message a subject
		->setSubject($contact->getTitre())

		// Set the From address with an associative array
		->setFrom($contact->getMail())

		// Set the To addresses with an associative array
		->setTo('84breizhinfoservices@gmail.com')

		// Give it a body
		->setBody(($this->renderView('EnsSitesBundle:Contact:email.txt.twig', array(
			'contact' => $contact,
		))));
		//ajouter un fichier joint
		   
		// Optionally add any attachments
	  	//->attach(Swift_Attachment::fromPath('/uploads/contacts/5320bebf0fd9e.ico'));

		$this->get('mailer')->send($message);	

		    /*ajouter flash message envoyer et envoyer mail */
		    $this->get('session')->getFlashBag()->add(
	            'notice',
	            'Votre demande est prise en compte!'
	        );
		 
		    return $this->redirect($this->generateUrl('EnsSitesBundle_homepage'));
		}

		 
	  return $this->render('EnsSitesBundle:Contact:new.html.twig', array(
	    'contacts' => $contacts,
	    'form'   => $form->createView()
	  ));
	}

	public function newAction()
    {
        $contacts = new Contact();
        $form   = $this->createForm(new ContactType(), $contacts);

        return $this->render('EnsSitesBundle:Contact:new.html.twig', array(
            'contacts' => $contacts,
            'form'   => $form->createView(),
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
        $entity = $em->getRepository('EnsSitesBundle:Contact')->find($id);
     
        if (!$entity) {
          throw $this->createNotFoundException('Unable to find Contact.');
        }
     
        $em->remove($entity);
        $em->flush();
     // }
     
      return $this->redirect($this->generateUrl('ens_admin_contact'));
    }

    public function showAction($id)
	{
		$em = $this->getDoctrine()->getManager();
	 
	    $entity = $em->getRepository('EnsSitesBundle:Contact')->find($id);
	 
	    if (!$entity) {
	        throw $this->createNotFoundException('Le contact demandé '.$id.' est introuvable');
	    }
	 
	    return $this->render('EnsSitesBundle:Contact:show.html.twig', array(
	        'entity'      => $entity,
	 
	    ));
	}
}