<?php
namespace App\Controller\Enquiry;

use App\Entity\Enquiry\Enquiry;
use App\Form\Enquiry\CreateType;
use App\Repository\Enquiry\EnquiryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/enquiry")
 */
class EnquiryController extends AbstractController
{
    /**
     * @Route("/list", name="app-enquiry-list")
     */
    public function indexAction()
    {
        $enquiries = $this->getDoctrine()->getRepository(Enquiry::class)->findAll();

        return $this->render('enquiry/index.html.twig', [
            'enquiries' => $enquiries,
        ]);
    }

    /**
     * @Route("/{id}/view", name="app-enquiry-view")
     * @param Enquiry $enquiry
     * @return Response
     */
    public function viewAction(Enquiry $enquiry)
    {
        return $this->render('enquiry/view.html.twig', [
            'enquiry' => $enquiry,
        ]);
    }

    /**
     * @Route("/create", name="app-enquiry-create")
     */
    public function createAction(Request $request)
    {
        /** @var EnquiryRepository $repo */
        $repo = $this->getDoctrine()->getRepository(Enquiry::class);

        $enquiry = $repo->createNew();

        $form = $this->createForm(CreateType::class, $enquiry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enquiry = $repo->save($enquiry);
        }

        return $this->render('enquiry/create.html.twig', [
            'form' => $form,
            'enquiry' => $enquiry,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app-enquiry-edit")
     */
    public function editAction(Request $request, Enquiry $enquiry)
    {
        /** @var EnquiryRepository $repo */
        $repo = $this->getDoctrine()->getRepository(Enquiry::class);

        $form = $this->createForm(EditFormType::class, $enquiry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enquiry = $repo->update($enquiry);
        }

        return $this->render('enquiry/edit.html.twig', [
            'form' => $form,
            'enquiry' => $enquiry,
        ]);
    }

    /**
     * @Route("/{id}/assign-consultant")
     * @param Request $request
     * @param Enquiry $enquiry
     */
    public function assignAction(Request $request, Enquiry $enquiry)
    {

    }

    /**
     * @Route("/{id}/delete", name="app-enquiry-delete")
     */
    public function deleteAction(Enquiry $enquiry)
    {
        return $this->redirectToRoute('app-enquiry-list', [], 200);
    }
}