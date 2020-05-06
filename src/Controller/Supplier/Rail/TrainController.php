<?php
namespace App\Controller\Supplier\Rail;

use App\Entity\Rail\Train;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TrainController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('supplier/rail/train/index.html.twig', [

        ]);
    }

    public function viewAction(Train $train)
    {
        return $this->render('supplier/rail/train/view.html.twig', [
            'train' => $train,
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->render('supplier/rail/train/create.html.twig', [

        ]);
    }

    public function editAction(Request $request, Train $train)
    {
        return $this->render('supplier/rail/train/edit.html.twig', [
            'train' => $train,
        ]);
    }

    public function deleteAction(Train $train)
    {
        return $this->redirectToRoute('', [], 200);
    }
}