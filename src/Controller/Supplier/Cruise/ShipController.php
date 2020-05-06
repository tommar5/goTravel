<?php
namespace App\Controller\Supplier\Cruise;

use App\Entity\Cruise\Ship;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ShipController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('supplier/cruise/ship/index.html.twig', [

        ]);
    }

    public function viewAction(Ship $ship)
    {
        return $this->render('supplier/cruise/ship/view.html.twig', [
            'ship' => $ship,
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->render('supplier/cruise/ship/create.html.twig', [

        ]);
    }

    public function editAction(Request $request, Ship $ship)
    {
        return $this->render('supplier/cruise/ship/edit.html.twig', [
            'ship' => $ship,
        ]);
    }

    public function deleteAction(Ship $ship)
    {
        return $this->redirectToRoute('', [], 200);
    }
}