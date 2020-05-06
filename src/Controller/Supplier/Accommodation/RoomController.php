<?php
namespace App\Controller\Supplier\Accommodation;

use App\Entity\Accommodation\Room;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class RoomController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('supplier/accommodation/room/index.html.twig', [

        ]);
    }

    public function viewAction(Room $room)
    {
        return $this->render('supplier/accommodation/room/view.html.twig', [
            'room' => $room,
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->render('supplier/accommodation/room/create.html.twig', [

        ]);
    }

    public function editAction(Request $request, Room $room)
    {
        return $this->render('supplier/accommodation/room/edit.html.twig', [
            'room' => $room,
        ]);
    }

    public function deleteAction(Room $room)
    {
        return $this->redirectToRoute('', [], 200);
    }
}