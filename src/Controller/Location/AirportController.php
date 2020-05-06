<?php
namespace App\Controller\Location;

use App\Entity\Location\Airport;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AirportController
 * @package App\Controller\Location
 * @Route("/location/airport")
 */
class AirportController extends AbstractController
{
    /**
     * @Route("/", name="app-location-airport")
     */
    public function index()
    {
        return $this->render('location/airport/index.html.twig', []);
    }

    /**
     * @Route("/{code}", name="app-location-airport-edit")
     * @ParamConverter("airport", options={"mapping": {"code": "code"}})
     * @param Airport $airport
     * @return Response
     */
    public function edit(Airport $airport)
    {
        return $this->render('location/airport/edit.html.twig', [
            'airport' => $airport,
        ]);
    }

    /**
     * @Route("/add", name="app-location-airport-add")
     */
    public function add()
    {
        return $this->render('location/airport/add.html.twig', [
        ]);
    }

    /**
     * @Route("/{code}/delete", name="app-location-airport-delete")
     * @ParamConverter("airport", options={"mapping": {"code": "code"}})
     * @param Airport $airport
     * @return RedirectResponse
     */
    public function delete(Airport $airport)
    {
        return $this->redirectToRoute('app-location-airport', [], 301);
    }
}