<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Album;

class AlbumController extends Controller
{
	public function indexAction(){

		$em = $this->getDoctrine()->getManager();

		$album = $em->getRepository('AppBundle:Album')
			->findAll();

		dump($album);

		return $this->render('AppBundle:Album:Index.html.twig', array(
        	'album' => $album )
        );
	}

	public function viewAction($name){
		return new Response('Album view!');
	}

	public function addAction(){

		$album = new Album();

		$album->setName('test1');
		$album->setDescription('blabla1');
		$album->setIsPublish(1);


		$em = $this->getDoctrine()->getManager();
		$em->persist($album);
		$em->flush();

		dump($album);

		return new Response('<html><body>Album OK!</body></html>');

	}
}