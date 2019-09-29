<?php

	namespace App\Controller;

	//use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	use App\Entity\Article;

	class ArticleController extends Controller {
		/**
		 * @Route("/article", name="article_list")
		 * @Method({"GET"})
		 */
		public function list() {

			$articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

			return $this->render('articles/list.html.twig', array('articles' => $articles));
		}

		/**
		 * @Route("/article/{id}", name="article_show")
		 */
		public function show($id) {
			$article = $this->getDoctrine()->getRepository(Article::class)->find($id);

			return $this->render('articles/show.html.twig', array('article' => $article));
		}

		/**
		 * @Route("/article/new", name="article_new")
		 */
		public function new() {
			return $this->render('articles/new.html.twig');
		}

		/**
		 * @Route("/article/save")
		 */
		// public function save() {
		// 	$entityManager = $this->getDoctrine()->getManager();

		// 	$article = new Article();
		// 	$article->setTitle('Article One');
		// 	$article->setBody('Body for article one');

		// 	$entityManager->persist($article);
		// 	$entityManager->flush();

		// 	return new Response('Saved an article with the id of ' . $article->getId());
		// }
	}