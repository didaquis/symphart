<?php

	namespace App\Controller;

	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\Routing\Annotation\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
		 * @Route("/article/new", name="article_new")
		 * @Method({"GET", "POST"})
		 */
		public function new(Request $request) {
			$article = new Article();

			$form = $this->createFormBuilder($article)
				->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
				->add('body', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
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
		 * @Route("/article/{id}", name="article_show")
		 * @Method({"GET"})
		 */
		public function show($id) {
			$article = $this->getDoctrine()->getRepository(Article::class)->find($id);

			return $this->render('articles/show.html.twig', array('article' => $article));
		}
	}