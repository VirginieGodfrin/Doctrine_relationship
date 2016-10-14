<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Album;
use AppBundle\Entity\Band;
use AppBundle\Entity\Category;

class AlbumController extends Controller
{
	public function indexAction(){

		$em = $this->getDoctrine()->getManager();

		$albums = $em->getRepository('AppBundle:Album')
			->findAllPublish();

		dump($albums);

		return $this->render('AppBundle:Album:Index.html.twig', array(
        	'albums' => $albums )
        );
	}

	public function viewAction(Album $album){

		dump($album);
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

	public function viewBandViaCategAction(Band $band){

		$bandCateg=[];

		foreach ($band->getCategories() as $bandCateg){
			/*dump($bandCateg);*/
			$bandCateg=[
				'id'=>$bandCateg->getId(),
				'name'=>$bandCateg->getName(),
				'band'=>$bandCateg->getBand()
			];
			
		} 

		/*
			$data = [
				'bandCateg'=>$bandCateg
			];
			return new JsonResponse($data);
		*/

		/*$bandCateg = $band->getCategories();*/

		dump($bandCateg);

		return $this->render('AppBundle:Album:bandCateg.html.twig', array(
        	'bandCateg' => $bandCateg )
        );

				
		/*return new Response('<html><body>band OK! </body></html>');*/
	}

	public function viewCategViaBandAction($name){

		
		
		$em = $this->getDoctrine()->getManager();

		$categBand = $em->getRepository('AppBundle:Band')
			->findOneByName($name);
		dump($categBand);
		return $this->render('AppBundle:Album:categBand.html.twig', array(
        	'categBand' => $categBand )
        );
	}

	public function addAction(){

		$band = new Band();
		$band->setName('Californie');

		$category = new category();
		$category->setName('Rock');
		$category->setBand($band);

		$album = new Album();

		$album->setName('One day');
		$album->setDescription('beautifuul song !');
		$album->setIsPublish(1);
		$album->setBand($band);


		$em = $this->getDoctrine()->getManager();
		$em->persist($band);
		$em->persist($category);
		$em->persist($album);
		$em->flush();

		dump($band);
		dump($category);
		dump($album);

		return new Response('<html><body>Album OK!</body></html>');

	}
}