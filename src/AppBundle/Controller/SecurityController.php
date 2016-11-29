<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\LoginForm;

class SecurityController extends Controller{

	public function loginAction(Request $request){

		$authenticationUtils = $this->get('security.authentication_utils');

	    // get the login error if there is one
	    $error = $authenticationUtils->getLastAuthenticationError();

	    // last username entered by the user
	    $lastUsername = $authenticationUtils->getLastUsername();

	    $form = $this->createForm(LoginForm::class,[
	    	'username' => $lastUsername,
	    	]);

	    return $this->render('AppBundle:Security:login.html.twig', array(
	        'form' => $form->createView(),
	        'error'=> $error,
	    ));

	}
}