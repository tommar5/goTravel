<?php
namespace App\Controller\Supplier\Flight;

use App\Entity\Airline\Airline;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AirlineController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('supplier/flight/airline/index.html.twig', [

        ]);
    }

    public function viewAction(Airline $airline)
    {
        return $this->render('supplier/flight/airline/view.html.twig', [
            'airline' => $airline,
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->render('supplier/flight/airline/create.html.twig', [

        ]);
    }

    public function editAction(Request $request, Airline $airline)
    {
        return $this->render('supplier/flight/airline/edit.html.twig', [
            'airline' => $airline,
        ]);
    }

    public function deleteAction(Airline $airline)
    {
        return $this->redirectToRoute('', [], 200);
    }
}