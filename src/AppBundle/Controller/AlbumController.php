<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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

	public function viewBandViaCategAndTagsAction(Band $band){
		$bandCateg=[];
		foreach ($band->getCategories() as $bandCateg){
			/*dump($bandCateg);*/
			$bandCateg=[
				'id'=>$bandCateg->getId(),
				'name'=>$bandCateg->getName(),
				'band'=>$bandCateg->getBand()
			];
			
		} 

		$bandTags=[];
		foreach ($band->getTags() as $bandTags){
			/*dump($bandTags);*/
			$bandTags=[
				'id'=>$bandTags->getId(),
				'name'=>$bandTags->getName(),
				'band'=>$bandTags->getBands()
			];
		}
		dump($bandCateg);
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
		dump($categTagsBand);
		return $this->render('AppBundle:Album:categTagsBand.html.twig', array(
        	'categTagsBand' => $categTagsBand )
        );
	}


	public function viewTagsViaBandsAction($id){
		$em = $this->getDoctrine()->getManager();

		$tagsBand = $em->getRepository('AppBundle:Band')
			->findBandViaTag($id);

		dump($tagsBand);

		return $this->render('AppBundle:Album:tagsBand.html.twig', array(
        	'tagsBand'=>$tagsBand
        	 )
        );

	}



	public function addAction(){

		$tags = new tags();
		$tags->setName('super super');
		
		$band = new Band();
		$band->setName('MoiMoi');
		$band->addTags($tags);

		$category = new category();
		$category->setName('classic');
		$category->setBand($band);

		$album = new Album();
		$album->setName('Castagnette');
		$album->setDescription('sympa et tout joli !');
		$album->setIsPublish(1);
		$album->setBand($band);


		$em = $this->getDoctrine()->getManager();
		$em->persist($category);
		$em->persist($album);
		$em->flush();

		dump($band);
		dump($category);
		dump($tags);
		dump($album);

		return new Response('<html><body>Album OK!</body></html>');

	}
}