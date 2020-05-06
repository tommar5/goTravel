<?php
namespace App\Controller\Supplier\Flight;

use App\Entity\Airline\Airplane;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PlaneController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('supplier/flight/plane/index.html.twig', [

        ]);
    }

    public function viewAction(Airplane $airplane)
    {
        return $this->render('supplier/flight/plane/view.html.twig', [
            'plane' => $airplane,
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->render('supplier/flight/plane/create.html.twig', [

        ]);
    }

    public function editAction(Request $request, Airplane $airplane)
    {
        return $this->render('supplier/flight/plane/edit.html.twig', [
            'plane' => $airplane,
        ]);
    }

    public function deleteAction(Airplane $airplane)
    {
        return $this->redirectToRoute('', [], 200);
    }
}