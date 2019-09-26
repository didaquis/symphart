<?php

	namespace App\Controller;

	use Symfony\Component\HttpFoundation\Response;

	class ArticleController {
		public function index() {
			return new Response('<html><body><h1>It Works</h1></body></html>');
		}
	}