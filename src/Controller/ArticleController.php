<?php

	namespace App\Controller;

	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

	class ArticleController {
		/**
		 * @Route("/")
		 * @Method({"GET"})
		 */
		public function index() {
			return new Response('<html><body><h1>It Works</h1></body></html>');
		}
	}