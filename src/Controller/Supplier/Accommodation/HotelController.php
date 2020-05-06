<?php
namespace App\Controller\Supplier\Accommodation;

use App\Entity\Accommodation\Hotel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HotelController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('supplier/accommodation/hotel/index.html.twig', [

        ]);
    }

    public function viewAction(Hotel $hotel)
    {
        return $this->render('supplier/accommodation/hotel/view.html.twig', [
            'hotel' => $hotel,
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->render('supplier/accommodation/hotel/create.html.twig', [

        ]);
    }

    public function editAction(Request $request, Hotel $hotel)
    {
        return $this->render('supplier/accommodation/hotel/edit.html.twig', [
            'hotel' => $hotel,
        ]);
    }

    public function deleteAction(Hotel $hotel)
    {
        return $this->redirectToRoute('', [], 200);
    }
}