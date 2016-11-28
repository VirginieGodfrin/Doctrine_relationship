<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Category;

use AppBundle\Form\CategoryType;


class CategoryController extends Controller
{
    public function indexAction(){

        $categ = $this->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->findAll();

        return $this->render('AppBundle:Admin\Categ:categIndex.html.twig',[
                'categ' => $categ,
            ]);

    }
	
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


		$categForm = $this->createForm(CategoryType::class, $categ);

			$categForm->handleRequest($request);

	    	if ($categForm->isSubmitted() && $categForm->isValid()) {

	        	$categ = $categForm->getData();
	        	dump($categ);
	        	$em = $this->getDoctrine()->getManager(); 
	        	$em->persist($categ);
				$em->flush();

	        	return $this->redirectToRoute('Categ_index');
	    	}
		
		
		return $this->render('AppBundle:Admin\Categ:categAdd.html.twig',[
				'categForm' => $categForm->createView()
			]);

	}

	public function editAction(Request $request, Category $categ){

        $formCateg = $this->createForm(CategoryType::class, $categ);

        $formCateg->handleRequest($request);

        if($formCateg->isSubmitted() && $formCateg->isValid() ){
            
            $categ = $formCateg->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categ);
            $em->flush();

            return $this->redirectToRoute('Categ_index');
        }

        return $this->render('AppBundle:Admin\Categ:categEdit.html.twig',[
            'formCateg'=>$formCateg->createView()
            ]
        );
    }

    public function deleteAction(Request $request, Category $categ){

    	$em = $this->getDoctrine()->getManager();

    	$categId = $categ->getId(); 

    	$categ = $em->getRepository('AppBundle:Category')
                    ->find($categId);

        $formCateg = $this->get('form.factory')->create();

        $formCateg->handleRequest($request);

        if($formCateg->isSubmitted()){

            $em = $this->getDoctrine()->getManager();
            $em->remove($categ);
            $em->flush();

            return $this->redirectToRoute('Categ_index');
        }

		return $this->render('AppBundle:Admin\Categ:categDelete.html.twig',[
        	'categ' => $categ,
            'formCateg' => $formCateg->createView()
            ]
        );
    }
}