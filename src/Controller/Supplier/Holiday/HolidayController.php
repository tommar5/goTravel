<?php
namespace App\Controller\Supplier\Holiday;

use App\Entity\Holiday\Holiday;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HolidayController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('supplier/holiday/index.html.twig', [

        ]);
    }

    public function viewAction(Holiday $holiday)
    {
        return $this->render('supplier/holiday/view.html.twig', [
            'holiday' => $holiday,
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->render('supplier/holiday/create.html.twig', [

        ]);
    }

    public function editAction(Request $request, Holiday $holiday)
    {
        return $this->render('supplier/holiday/edit.html.twig', [
            'holiday' => $holiday,
        ]);
    }

    public function deleteAction(Holiday $holiday)
    {
        return $this->redirectToRoute('', [], 200);
    }
}