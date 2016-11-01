<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\User;



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
}