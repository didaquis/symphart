<?php

	namespace App\Controller;

	use Symfony\Component\Routing\Annotation\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	class HomeController extends Controller {
		/**
		 * @Route("/", name="home")
		 * @Method({"GET"})
		 */
		public function home() {
			return $this->render('home/home.html.twig');
		}
	}