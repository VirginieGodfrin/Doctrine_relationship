<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\User;
use AppBundle\Entity\Label;
use AppBundle\Entity\Artiste;
use AppBundle\Form\UserRegistrationType;



class UserController extends Controller
{
	public function viewuserAction(User $user){

		$name = $user->getName();

		$em = $this->getDoctrine()->getManager();
		
		$user = $em->getRepository('AppBundle:User')
				->findOneBy(['name' => $name]);

		$userEvent=[];

		foreach ($user->getEvents() as $userEvent){
			$userEvent=[
				'id'=>$userEvent->getId(),
				'name'=>$userEvent->getName(),
				'datetime'=>$userEvent->getStratTime()
			];
			
		} 

		return $this->render('AppBundle:User:Index.html.twig', array(
        	'user' => $user,
        	'userEvent' => $userEvent )
        );

	}

	public function registerAction(Request $request){

			$form = $this->createForm(UserRegistrationType::class);
			$form->handleRequest($request);

			/*$artiste = new Artiste();
			$artiste->setRoles(["ROLE_USER"]);*/

			if($form->isValid()){
				$artiste = $form->getData();
				$artiste->setRoles(["ROLE_USER"]);
				$em = $this->getDoctrine()->getManager();
				$em->persist($artiste);
				$em->flush();

				$this->addFlash('success', 'Welcome '.$artiste->getSpeudo());
				return $this->redirectToRoute('Home');
			}

			return $this->render('AppBundle:User:register.html.twig', [
				'form' => $form->createView()
				]);
	}
}