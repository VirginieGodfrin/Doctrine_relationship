<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Band;
use AppBundle\Entity\Tags;
use AppBundle\Entity\Album;


class AlbumController extends Controller
{
	
	public function newAction(){

		$tags = new Tags();
		$tags->setName("testtagAlbum");

		$band = new Band();
		$band->setName("testbandAlbum");
		$band->addtags($tags);

		$album = new Album();
		$album->setName("Albumtest1");
		$album->setDescription("description Album test 1");
		$album->setBand($band);


		$em = $this->getDoctrine()->getManager();
		$em->persist($tags);
        $em->persist($band);
        $em->persist($album);
        $em->flush();
           
		return new Response('<html><body>New Album ok!</body></html>');

	}

	public function editAction(band $band){
           
		return $this->render('AppBundle:Admin:bandEdit.html.twig');

	}
}