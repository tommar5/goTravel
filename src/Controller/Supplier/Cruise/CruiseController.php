<?php
namespace App\Controller\Supplier\Cruise;

use App\Entity\Cruise\Cruise;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CruiseController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('supplier/cruise/cruise/index.html.twig', [

        ]);
    }

    public function viewAction(Cruise $cruise)
    {
        return $this->render('supplier/cruise/cruise/view.html.twig', [
            'cruise' => $cruise,
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->render('supplier/cruise/cruise/create.html.twig', [

        ]);
    }

    public function editAction(Request $request, Cruise $cruise)
    {
        return $this->render('supplier/cruise/cruise/edit.html.twig', [
            'cruise' => $cruise,
        ]);
    }

    public function deleteAction(Cruise $cruise)
    {
        return $this->redirectToRoute('', [], 200);
    }
}