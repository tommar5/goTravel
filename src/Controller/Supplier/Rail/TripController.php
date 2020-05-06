<?php
namespace App\Controller\Supplier\Rail;

use App\Entity\Rail\Trip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TripController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('supplier/rail/trip/index.html.twig', [

        ]);
    }

    public function viewAction(Trip $trip)
    {
        return $this->render('supplier/rail/trip/view.html.twig', [
            'trip' => $trip,
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->render('supplier/rail/trip/create.html.twig', [

        ]);
    }

    public function editAction(Request $request, Trip $trip)
    {
        return $this->render('supplier/rail/trip/edit.html.twig', [
            'trip' => $trip,
        ]);
    }

    public function deleteAction(Trip $trip)
    {
        return $this->redirectToRoute('', [], 200);
    }
}