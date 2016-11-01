<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;



class EventController extends Controller
{
	public function indexAction(){
		$em = $this->getDoctrine()->getManager();

		$events = $em->getRepository('AppBundle:Event')
			->findAll();

		dump($events);
		
		return $this->render('AppBundle:Event:Index.html.twig', array(
        	'events' => $events )
        );
	}
}