<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class EventController extends Controller
{
	/**
	 * @Security("is_granted('ROLE_USER')")
	 */
	public function indexAction(){

		$em = $this->getDoctrine()->getManager();

		$events = $em->getRepository('AppBundle:Event')
			->findAll();

		return $this->render('AppBundle:Event:Index.html.twig', array(
        	'events' => $events )
        );
	}

	public function villeEventAction($name){

		$em = $this->getDoctrine()->getManager();

		$concertHall = $em->getRepository('AppBundle:ConcertHall')
			->findOneByName($name);

		$id = $concertHall->getId();	

		$ville = $em->getRepository('AppBundle:Ville')
			->findVilleByConcertHall($id);
			
		return $this->render('AppBundle:Event:ville.html.twig', array(
        	'ville' => $ville )
        );
	}
}