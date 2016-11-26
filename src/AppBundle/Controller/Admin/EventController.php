<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Form\EventType;

use AppBundle\Entity\Tags;
use AppBundle\Entity\Band;
use AppBundle\Entity\Category;
use AppBundle\Entity\ConcertHall;
use AppBundle\Entity\Event;
use AppBundle\Entity\User;


class EventController extends Controller
{
	public function indexAction(){

        $event = $this->getDoctrine()
            ->getRepository('AppBundle:Event')
            ->findAll();

		return $this->render('AppBundle:Admin\Event:eventIndex.html.twig',[
				'event' => $event
			]);

	}
	public function newAction(){

		$tags = new Tags();
		$tags->setName("testtag2");

		$band = new Band();
		$band->setName("testband2");
		$band->addtags($tags);

		$categ = new Category();
		$categ->setName("categtest2");
		$categ->setBand($band);

		$concerthall = new ConcertHall();
		$concerthall->setName("concerthall test1");
		$concerthall->setAdresse("adresse concerthall test1");
		$concerthall->setHomeNumber("66");
		$concerthall->setPhoneNumber("1234567890");
		$concerthall->setEmail("halldeconcert@gmail.com");
		$concerthall->setWebsite("halldeconcert.be");

		$event = new Event();
		$event->setName("testevent1");
		$event->setdescription("test description event 1");
		$event->setStratTime(new \DateTime());
		$event->setEndTime(new \DateTime());
		$event->addBand($band);
		$event->setConcertHall($concerthall);

		$user = new User();
		$user->setName("userTest1");
		$user->setFirstName("userFirstNameTest1");
		$user->setEmail("userFirstNameTest1");
		$user->addEvent($event);


		$em = $this->getDoctrine()->getManager();
		$em->persist($tags);
        $em->persist($band);
        $em->persist($categ);
        $em->persist($concerthall);
        $em->persist($event);
        $em->persist($user);
        $em->flush();
           
		return new Response('<html><body>New Event ok!</body></html>');

	}

	public function addAction(Request $request){

		$eventForm = $this->createForm(EventType::class);

		if($request->isMethod('POST')){

			$eventForm->handleRequest($request);

	    	if ($eventForm->isSubmitted() && $eventForm->isValid()) {

	        	$event = $eventForm->getData();

	        	$em = $this->getDoctrine()->getManager(); 
	        	$em->persist($event);
				$em->flush();

	        	return $this->redirectToRoute('Admin');
	    	}
		}
		
		return $this->render('AppBundle:Admin\Event:eventAdd.html.twig',[
				'eventForm' => $eventForm->createView()
			]);

	}


	public function editAction(Request $request, Event $event){

        $eventForm = $this->createForm(EventType::class, $event);

        if($request->isMethod('POST')){

	        $eventForm->handleRequest($request);

	        if($eventForm->isSubmitted() && $eventForm->isValid() ){
	            
	            $event = $eventForm->getData();

	            $em = $this->getDoctrine()->getManager();

	            $em->flush();

	            return $this->redirectToRoute('Admin');
	        }
	    }

        return $this->render('AppBundle:Admin\Event:eventEdit.html.twig',[
            'eventForm'=>$eventForm->createView()
            ]
        );
    }

    public function deleteAction(Request $request, Event $event){

    	$em = $this->getDoctrine()->getManager();

    	$eventId = $event->getId(); 

    	$event = $em->getRepository('AppBundle:Event')
    				->find($eventId);

        $eventForm = $this->get('form.factory')->create();

        if($request->isMethod('POST')){

	        $eventForm->handleRequest($request);

	        if($eventForm->isSubmitted()){
	        	$em = $this->getDoctrine()->getManager();
	            $em->remove($event);
	            $em->flush();

	            return $this->redirectToRoute('Admin');
	        }
	    }

		return $this->render('AppBundle:Admin\Event:eventDelete.html.twig',[
        	'event' => $event,
            'eventForm' => $eventForm->createView()
            ]
        );
    }
}