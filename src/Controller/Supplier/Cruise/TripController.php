<?php
namespace App\Controller\Supplier\Cruise;

use App\Entity\Cruise\Trip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TripController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('supplier/cruise/trip/index.html.twig', [

        ]);
    }

    public function viewAction(Trip $trip)
    {
        return $this->render('supplier/cruise/trip/view.html.twig', [
            'trip' => $trip,
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->render('supplier/cruise/trip/create.html.twig', [

        ]);
    }

    public function editAction(Request $request, Trip $trip)
    {
        return $this->render('supplier/cruise/trip/edit.html.twig', [
            'trip' => $trip,
        ]);
    }

    public function deleteAction(Trip $trip)
    {
        return $this->redirectToRoute('', [], 200);
    }
}