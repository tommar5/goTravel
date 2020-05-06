<?php
namespace App\Controller\Quote;

use App\Entity\Quote\Quote;
use App\Repository\Quote\QuoteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/quote")
 */
class QuoteController extends AbstractController
{
    /**
     * @Route("/list", name="app-quote-list")
     */
    public function indexAction()
    {
        $quotes = $this->getDoctrine()->getRepository(Quote::class)->findAll();

        return $this->render('quote/index.html.twig', [
            'quotes' => $quotes,
        ]);
    }

    /**
     * @Route("/{id}/view", name="app-quote-view")
     * @param Quote $quote
     * @return Response
     */
    public function viewAction(Quote $quote)
    {
        return $this->render('quote/view.html.twig', [
            'quote' => $quote,
        ]);
    }

    /**
     * @Route("/create", name="app-quote-create")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        /** @var QuoteRepository $repo */
        $repo = $this->getDoctrine()->getRepository(Quote::class);

        $quote = $repo->createNew();

        $form = $this->createForm(CreateFormType::class, $quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quote = $repo->save($quote);
        }

        return $this->render('quote/create.html.twig', [
            'form' => $form,
            'quote' => $quote,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app-quote-edit")
     * @param Request $request
     * @param Quote $quote
     * @return Response
     */
    public function editAction(Request $request, Quote $quote)
    {
        $form = $this->createForm(EditFormType::class, $quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var QuoteRepository $repo */
            $repo = $this->getDoctrine()->getRepository(Quote::class);

            $quote = $repo->update($quote);
        }

        return $this->render('quote/edit.html.twig', [
            'form' => $form,
            'quote' => $quote,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="app-quote-delete")
     */
    public function deleteAction(Quote $quote)
    {
        return $this->redirectToRoute('app-quote-list', [], 200);
    }
}