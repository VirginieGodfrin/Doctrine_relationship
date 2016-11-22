<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Album;
use AppBundle\Entity\Band;
use AppBundle\Entity\Category;
use AppBundle\Entity\Tags;

class AlbumController extends Controller
{
	public function indexAction(){

		$em = $this->getDoctrine()->getManager();

		$albums = $em->getRepository('AppBundle:Album')
			->findAllPublish();

		return $this->render('AppBundle:Album:Index.html.twig', array(
        	'albums' => $albums )
        );
	}

	public function viewAction(Album $album){

		$name = $album->getName();

		$em = $this->getDoctrine()->getManager();

		$album = $em->getRepository('AppBundle:Album')
				->findOneBy(['name' => $name]);

		if(!$album){
			throw $this->createNotFoundException('pas d\'album trouvé');
		}
		
		return $this->render('AppBundle:Album:oneAlbum.html.twig', array(
        	'album' => $album )
        );
		return new Response('<html><body>Album view OK!</body></html>');
	}

	public function viewBandViaCategAndTagsAction(Band $band){
		$bandCateg=[];
		foreach ($band->getCategories() as $bandCateg){

			$bandCateg=[
				'id'=>$bandCateg->getId(),
				'name'=>$bandCateg->getName(),
				'band'=>$bandCateg->getBand()
			];
			
		} 

		$bandTags=[];
		foreach ($band->getTags() as $bandTags){

			$bandTags=[
				'id'=>$bandTags->getId(),
				'name'=>$bandTags->getName(),
				'band'=>$bandTags->getBands()
			];
		}

		return $this->render('AppBundle:Album:bandCategTags.html.twig', array(
        	'bandCateg' => $bandCateg,
        	'bandTags'=>$bandTags,
        	 )
        );		
	}

	public function viewCategAndTagsViaBandAction($name){

		$em = $this->getDoctrine()->getManager();

		$categTagsBand = $em->getRepository('AppBundle:Band')
			->findOneByName($name);

		return $this->render('AppBundle:Album:categTagsBand.html.twig', array(
        	'categTagsBand' => $categTagsBand )
        );
	}


	public function viewTagsViaBandsAction($id){
		$em = $this->getDoctrine()->getManager();

		$tagsBand = $em->getRepository('AppBundle:Band')
			->findBandViaTag($id);

		return $this->render('AppBundle:Album:tagsBand.html.twig', array(
        	'tagsBand'=>$tagsBand
        	 )
        );

	}

	
}