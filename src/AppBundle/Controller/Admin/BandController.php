<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\PersistentCollection; 

use Doctrine\Common\Collections\ArrayCollection;   

use AppBundle\Form\BandType;

use AppBundle\Entity\Tags;
use AppBundle\Entity\Band;
use AppBundle\Entity\Category;
use AppBundle\Entity\Event;

class BandController extends Controller
{
	public function indexAction(){

		$band = $this->getDoctrine()
            ->getRepository('AppBundle:Band')
            ->findAll();

		return $this->render('AppBundle:Admin\Band:bandIndex.html.twig',[
				'band' => $band,
			]);

	}
	
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

		$band = new Band();

		$bandForm = $this->createForm(BandType::class, $band);

			$bandForm->handleRequest($request);

	    	if ($bandForm->isSubmitted() && $bandForm->isValid()) {

	        	$band = $bandForm->getData();
	        	dump($band);
	        	$em = $this->getDoctrine()->getManager(); 
	        	$em->persist($band);
				$em->flush();

				$this->addFlash('success', 'Band ajouté !');

	        	return $this->redirectToRoute('Band_index');
	    	}
		
		
		return $this->render('AppBundle:Admin\Band:bandAdd.html.twig',[
				'bandForm' => $bandForm->createView()
			]);

	}

	public function editAction(Request $request, Band $band){

        $bandForm = $this->createForm(BandType::class, $band);

        $bandForm->handleRequest($request);

        if($bandForm->isSubmitted() && $bandForm->isValid()){

            $em = $this->getDoctrine()->getManager();

            $band = $bandForm->getData();

            $em->flush();

            $this->addFlash('success', 'Band modifié !');

            return $this->redirectToRoute('Band_index');
        }

        return $this->render('AppBundle:Admin\Band:bandEdit.html.twig',[
            'bandForm'=>$bandForm->createView()
            ]
        );
    }

    public function deleteAction(Request $request, Band $band){

    	$em = $this->getDoctrine()->getManager();

    	$bandId = $band->getId(); 

    	$band = $em->getRepository('AppBundle:Band')
    			->find($bandId);

        $bandForm = $this->get('form.factory')->create();

        $bandForm->handleRequest($request);

        if($bandForm->isSubmitted()){

            $em = $this->getDoctrine()->getManager();
            $em->remove($band);
            $em->flush();

            $this->addFlash('success', 'Band suprimé !');

            return $this->redirectToRoute('Band_index');
        }

		return $this->render('AppBundle:Admin\Band:bandDelete.html.twig',[
        	'band' => $band,
            'bandForm' => $bandForm->createView()
            ]
        );
    }
}