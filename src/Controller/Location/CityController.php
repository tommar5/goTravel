<?php
namespace App\Controller\Location;

use App\Entity\Location\City;
use App\Form\Location\City\AddFormType;
use App\Form\Location\City\EditFormType;
use App\Repository\Location\CityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class CityController
 * @package App\Controller\Location
 * @Route("/location/city")
 */
class CityController extends AbstractController
{
    /**
     * @Route("/", name="app-location-city")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(City::class);

        $cities = $repo->findAll();

        return $this->render('location/city/index.html.twig', [
            'cities' => $cities,
        ]);
    }

    /**
     * @Route("/{code}", name="app-location-city-edit")
     * @ParamConverter("city", options={"mapping": {"code": "code"}})
     * @param Request $request
     * @param City $city
     * @return Response
     */
    public function edit(Request $request, City $city)
    {
        $form = $this->createForm(EditFormType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CityRepository $repo */
            $repo = $this->getDoctrine()->getRepository(City::class);

            $repo->save($city);

            $this->addFlash('success', '');
        }

        return $this->render('location/city/edit.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/add", name="app-location-city-add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request)
    {
        /** @var CityRepository $repo */
        $repo = $this->getDoctrine()->getRepository(City::class);

        $city = $repo->createNew();

        $form = $this->createForm(AddFormType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($city);

            $this->addFlash('success', '');

            return $this->redirectToRoute('app-location-city-edit', ['code' => $city->getCode()], 301);
        }

        return $this->render('location/city/add.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{code}/delete", name="app-location-city-delete")
     * @ParamConverter("city", options={"mapping": {"code": "code"}})
     * @param City $city
     * @return RedirectResponse
     */
    public function delete(City $city)
    {
        return $this->redirectToRoute('app-location-city', [], 301);
    }
}