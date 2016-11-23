<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Category;

use AppBundle\Form\CategoryType;


class CategoryController extends Controller
{
	
	public function newAction(){

		$band = new Band();
		$band->setName("testband1");

		$categ = new Category();
		$categ->setName("categtest1");
		$categ->setBand($band);


		$em = $this->getDoctrine()->getManager();
        $em->persist($band);
        $em->persist($categ);
        $em->flush();
           
		return new Response('<html><body>New categ ok!</body></html>');

	}

	public function addAction(Request $request){

		$categ = new Category();

		/*$bandForm = $this->createFormBuilder($band)
        ->add('name', TextType::class)
        ->add('tags')
        ->add('categories')
        ->add('save', SubmitType::class, array('label' => 'Create Band'))
        ->getForm();*/

		$categForm = $this->createForm(CategoryType::class, $categ);

			$categForm->handleRequest($request);

	    	if ($categForm->isSubmitted() && $categForm->isValid()) {

	        	$categ = $categForm->getData();
	        	dump($categ);
	        	$em = $this->getDoctrine()->getManager(); 
	        	$em->persist($categ);
				$em->flush();

	        	return $this->redirectToRoute('Admin');
	    	}
		
		
		return $this->render('AppBundle:Admin:categAdd.html.twig',[
				'categForm' => $categForm->createView()
			]);

	}

	public function editAction(band $band){
           
		return $this->render('AppBundle:Admin:bandEdit.html.twig');

	}
}