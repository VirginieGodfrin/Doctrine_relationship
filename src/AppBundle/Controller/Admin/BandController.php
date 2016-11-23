<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Form\BandType;
use AppBundle\Entity\Tags;
use AppBundle\Entity\Band;
use AppBundle\Entity\Category;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



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

	public function addAction(Request $request){

		$band= new Band();


		$bandForm = $this->createFormBuilder($band)
        ->add('name', TextType::class)
        ->add('tags')
        ->add('categories')
        ->add('save', SubmitType::class, array('label' => 'Create Band'))
        ->getForm();

		/*$bandForm = $this->createForm(BandType::class);*/

		

			$bandForm->handleRequest($request);

	    	if ($bandForm->isSubmitted() && $bandForm->isValid()) {

	        	$band = $bandForm->getData();
	        	dump($band);
	        	$em = $this->getDoctrine()->getManager(); 
	        	$em->persist($band);
				$em->flush();

	        	return $this->redirectToRoute('Admin');
	    	}
		
		
		return $this->render('AppBundle:Admin:bandAdd.html.twig',[
				'bandForm' => $bandForm->createView()
			]);

	}

	public function editAction(band $band){
           
		return $this->render('AppBundle:Admin:bandEdit.html.twig');

	}
}