<?php
namespace App\Controller\Supplier\Flight;

use App\Entity\Airline\Flight;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FlightController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('supplier/flight/flight/index.html.twig', [

        ]);
    }

    public function viewAction(Flight $flight)
    {
        return $this->render('supplier/flight/flight/view.html.twig', [
            'flight' => $flight,
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->render('supplier/flight/flight/create.html.twig', [

        ]);
    }

    public function editAction(Request $request, Flight $flight)
    {
        return $this->render('supplier/flight/flight/edit.html.twig', [
            'flight' => $flight,
        ]);
    }

    public function deleteAction(Flight $flight)
    {
        return $this->redirectToRoute('', [], 200);
    }
}