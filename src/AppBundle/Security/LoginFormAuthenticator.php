<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\RouterInterface;

use AppBundle\Form\LoginForm;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator{

	private $formFactory;
	private $em;
	private $router;

	public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router){

		$this->formFactory = $formFactory;
		$this->em = $em;
		$this->router = $router;

	}

	public function getCredentials(Request $request){

		$isLoginSubmit = $request->getPathInfo() == '/login' && $request->isMethod('POST');
		
		if (!$isLoginSubmit) {
			// skip authentication
			return; 
		}

		$form = $this->formFactory->create(LoginForm::class);
		$form->handleRequest($request);

		$data = $form->getData();
		
		$request->getSession()->set(
			Security::LAST_USERNAME,
			$data['username']
			);

		return $data;

 	}

	public function getUser($credentials, UserProviderInterface $userProvider){

		$username = $credentials['username'];
		return $this->em->getRepository('AppBundle:User') 
			->findOneBy(['email' => $username]);

	}

	public function checkCredentials($credentials, UserInterface $user){
		$password = $credentials['password'];

		if ($password == 'bibi') { 
			return true;
		}
		return false;
	}

	protected function getLoginUrl(){

		return $this->router->generate('Login');

	}

	protected function getDefaultSuccessRedirectUrl(){

		return $this->router->generate('Admin');

	}



}