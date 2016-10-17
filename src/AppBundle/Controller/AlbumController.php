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

				
		/*return new Response('<html><body> viewTagsViaBands OK! </body></html>');*/
	}



	public function addAction(){

		$tags1 = new tags();
		$tags1->setName('super super');

		$tags2 = new tags();
		$tags2->setName('bad bad');
		
		$band1 = new Band();
		$band1->setName('MoiMoi');
		$band1->addTags($tags1,$tags2);

		$band2 = new Band();
		$band2->setName('YoupieYoupie');
		$band2->addTags($tags1,$tags2);

		$category = new category();
		$category->setName('classic');
		$category->setBand($band1, $band2);

		$album1 = new Album();
		$album1->setName('Castagnette');
		$album1->setDescription('sympa et tout joli !');
		$album1->setIsPublish(1);
		$album1->setBand($band1);

		$album2 = new Album();
		$album2->setName('Piano');
		$album2->setDescription('Magnifique qu\'on y a rien vu!');
		$album2->setIsPublish(1);
		$album2->setBand($band2);


		$em = $this->getDoctrine()->getManager();
		$em->persist($category);
		$em->persist($album1);
		$em->persist($album2);
		$em->flush();

		dump($band1);
		dump($band2);
		dump($category);
		dump($tags1);
		dump($tags2);
		dump($album1);
		dump($album2);

		return new Response('<html><body>Album OK!</body></html>');

	}
}