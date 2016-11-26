<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Band;
use AppBundle\Entity\Tags;
use AppBundle\Entity\Album;


use AppBundle\Form\AlbumType;

class AlbumController extends Controller
{
	public function indexAction(){

        $album = $this->getDoctrine()
            ->getRepository('AppBundle:Album')
            ->findAll();

		return $this->render('AppBundle:Admin\Album:albumIndex.html.twig',[
				'album' => $album
			]);

	}
	
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

	public function addAction(Request $request){

		$albumForm = $this->createForm(AlbumType::class);

		if($request->isMethod('POST')){

			$albumForm->handleRequest($request);

	    	if ($albumForm->isSubmitted() && $albumForm->isValid()) {

	        	$album = $albumForm->getData();

	        	$em = $this->getDoctrine()->getManager(); 
	        	$em->persist($album);
				$em->flush();

	        	return $this->redirectToRoute('Album_index');
	    	}
		}
		
		return $this->render('AppBundle:Admin\Album:albumAdd.html.twig',[
				'albumForm' => $albumForm->createView()
			]);

	}

	public function editAction(Request $request, Album $album){

        $albumForm = $this->createForm(AlbumType::class, $album);

        $albumForm->handleRequest($request);

        if($albumForm->isSubmitted() && $albumForm->isValid()){

            $em = $this->getDoctrine()->getManager();

            $album = $albumForm->getData();

            $em->flush();

            return $this->redirectToRoute('Album_index');
        }

        return $this->render('AppBundle:Admin\Album:albumEdit.html.twig',[
            'albumForm'=>$albumForm->createView()
            ]
        );
    }

    public function deleteAction(Request $request, Album $album){

    	$em = $this->getDoctrine()->getManager();

    	$albumId = $album->getId(); 

    	$album = $em->getRepository('AppBundle:Album')
    			->find($albumId);

        $albumForm = $this->get('form.factory')->create();

        $albumForm->handleRequest($request);

        if($albumForm->isSubmitted()){

            $em = $this->getDoctrine()->getManager();
            $em->remove($album);
            $em->flush();

            return $this->redirectToRoute('Album_index');
        }

		return $this->render('AppBundle:Admin\Album:albumDelete.html.twig',[
        	'album' => $album,
            'albumForm' => $albumForm->createView()
            ]
        );
    }
}