<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Album;
use AppBundle\Entity\Band;
use AppBundle\Entity\Category;
use AppBundle\Entity\Tags;

class HomeController extends Controller
{
	public function indexAction(){

		return $this->render('AppBundle:Home:Index.html.twig');
	}
}