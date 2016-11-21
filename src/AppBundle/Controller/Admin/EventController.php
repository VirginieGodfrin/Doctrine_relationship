<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Event;


class EventController extends Controller
{
	public function editAction(){
           
		return $this->render('AppBundle:Admin:eventEdit.html.twig');

	}

	/*public function addAction(){
           
		return $this->render('AppBundle:Admin:index.html.twig');

	}*/
}