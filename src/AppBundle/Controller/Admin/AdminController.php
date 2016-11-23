<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
	public function indexAction(){

		$band = $this->getDoctrine()
            ->getRepository('AppBundle:Band')
            ->findAll();

        $categ = $this->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->findAll();

        $event = $this->getDoctrine()
            ->getRepository('AppBundle:Event')
            ->findAll();

        $album = $this->getDoctrine()
            ->getRepository('AppBundle:Album')
            ->findAll();

		return $this->render('AppBundle:Admin:Index.html.twig',[
				'band' => $band,
				'categ' => $categ,
				'event' => $event,
				'album' => $album
			]);

	}
}