<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Band;
use AppBundle\Entity\Tags;
use AppBundle\Entity\Category;


class BandController extends Controller
{
	
	public function newAction(){

		$tags = new Tags();
		$tags->setName("testtag1");

		$band = new Band();
		$band->setName("testband1");
		$band->addtags($tags);

		$categ = new Category();
		$categ->setName("categtest1");
		$categ->setBand($band);


		$em = $this->getDoctrine()->getManager();
		$em->persist($tags);
        $em->persist($band);
        $em->persist($categ);
        $em->flush();
           
		return new Response('<html><body>New Band ok!</body></html>');

	}

	public function editAction(band $band){
           
		return $this->render('AppBundle:Admin:bandEdit.html.twig');

	}
}