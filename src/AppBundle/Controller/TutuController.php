<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
	public function indexAction(){
		return $this->render('AppBundle:Admin:Index.html.twig');
	}
}