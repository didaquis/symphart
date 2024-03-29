<?php

	namespace App\Controller;

	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;

	use App\Entity\Article;

	class ArticleController extends AbstractController {
		/**
		 * @Route("/article", name="article_list", methods={"GET"})
		 */
		public function list() {
			$articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

			return $this->render('articles/list.html.twig', array('articles' => $articles));
		}


		/**
		 * @Route("/article/new", name="article_new", methods={"GET","POST"})
		 */
		public function new(Request $request) {
			$article = new Article();

			$form = $this->createFormBuilder($article)
				->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
				->add('body', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control'), 'empty_data' => ''))
				->add('save', SubmitType::class, array('label' => 'Create New Article', 'attr' => array('class' => 'btn btn-primary mt-3')))
				->getForm();

			$form->handleRequest($request);
			if($form->isSubmitted() && $form->isValid()) {
				$article = $form->getData();

				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($article);
				$entityManager->flush();

				return $this->redirectToRoute('article_list');
			}

			return $this->render('articles/new.html.twig', array('form' => $form->createView()));
		}


		/**
		 * @Route("/article/edit/{id}", name="article_edit", methods={"GET","POST"})
		 */
		public function edit(Request $request, $id) {
			$article = new Article();
			$article = $this->getDoctrine()->getRepository(Article::class)->find($id);

			$form = $this->createFormBuilder($article)
				->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
				->add('body', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control'), 'empty_data' => ''))
				->add('save', SubmitType::class, array('label' => 'Update Article', 'attr' => array('class' => 'btn btn-primary mt-3')))
				->getForm();

			$form->handleRequest($request);
			if($form->isSubmitted() && $form->isValid()) {
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->flush();

				return $this->redirectToRoute('article_list');
			}

			return $this->render('articles/edit.html.twig', array('form' => $form->createView()));
		}


		/**
		 * @Route("/article/{id}", name="article_show", methods={"GET"})
		 */
		public function show($id) {
			$article = $this->getDoctrine()->getRepository(Article::class)->find($id);

			return $this->render('articles/show.html.twig', array('article' => $article));
		}

		/**
		 * @Route("/article/delete/{id}", name="article_delete", methods={"DELETE"})
		 */
		public function delete(Request $request, $id) {
			$article = $this->getDoctrine()->getRepository(Article::class)->find($id);

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($article);
			$entityManager->flush();

			$response = new Response('', Response::HTTP_OK);
			return $response->send();
		}
	}