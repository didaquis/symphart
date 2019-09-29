<?php

	namespace App\Controller;

	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	use App\Entity\Article;

	class ArticleController extends Controller {
		/**
		 * @Route("/")
		 * @Method({"GET"})
		 */
		public function index() {

			$articles = ['Article 1', 'Article 2', 'Article 3'];

			return $this->render('articles/index.html.twig', array('articles' => $articles));
		}

		/**
		 * @Route("/article/new")
		 * @Method({"GET"})
		 */
		public function new() {
			return $this->render('articles/new.html.twig');
		}

		/**
		 * @Route("/article/save")
		 */
		public function save() {
			$entityManager = $this->getDoctrine()->getManager();

			$article = new Article();
			$article->setTitle('Article One');
			$article->setBody('Body for article one');

			$entityManager->persist($article);
			$entityManager->flush();

			return new Response('Saves an article with the id of ' . $article->getId());
		}
	}