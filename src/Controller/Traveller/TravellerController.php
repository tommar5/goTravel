<?php
namespace App\Controller\Traveller;

use App\Entity\Traveller\Traveller;
use App\Repository\Traveller\TravellerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/traveller")
 */
class TravellerController extends AbstractController
{
    /**
     * @Route("/list", name="app-traveller-list")
     */
    public function indexAction()
    {
        $travellers = $this->getDoctrine()->getRepository(Traveller::class)->findAll();

        return $this->render('traveller/index.html.twig', [
           'travellers' => $travellers,
        ]);
    }

    /**
     * @Route("/{id}/view", name="app-traveller-view")
     * @param Traveller $traveller
     * @return Response
     */
    public function viewAction(Traveller $traveller)
    {
        return $this->render('traveller/view.html.twig', [
           'traveller' => $traveller,
        ]);
    }

    /**
     * @Route("/create", name="app-traveller-create")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        /** @var TravellerRepository $repo */
        $repo = $this->getDoctrine()->getRepository(Traveller::class);

        $traveller = $repo->createNew();

        $form = $this->createForm(CreateFormType::class, $traveller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $traveller = $repo->save($traveller);
        }

        return $this->render('traveller/create.html.twig', [
           'form' => $form,
           'traveller' => $traveller,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app-traveller-edit")
     * @param Request $request
     * @param Traveller $traveller
     * @return Response
     */
    public function editAction(Request $request, Traveller $traveller)
    {
        $form = $this->createForm(EditFormType::class, $traveller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var TravellerRepository $repo */
            $repo = $this->getDoctrine()->getRepository(Traveller::class);

            $traveller = $repo->update($traveller);
        }

        return $this->render('traveller/edit.html.twig', [
            'form' => $form,
            'traveller' => $traveller,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="app-traveller-list")
     * @param Traveller $traveller
     * @return RedirectResponse
     */
    public function deleteAction(Traveller $traveller)
    {
        return $this->redirectToRoute('app-traveller-list', [], 200);
    }
}