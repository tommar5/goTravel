<?php
namespace App\Controller\Location;

use App\Entity\Location\Country;
use App\Form\Location\Country\EditFormType;
use App\Repository\Location\CountryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class CountryController
 * @package App\Controller\Location
 * @Route("/location/country")
 */
class CountryController extends AbstractController
{
    /**
     * @Route("/", name="app-location-country")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Country::class);

        $countries = $repo->findAll();

        return $this->render('location/country/index.html.twig', [
            'countries' => $countries,
        ]);
    }

    /**
     * @Route("/{code}", name="app-location-country-edit")
     * @ParamConverter("country", options={"mapping": {"code": "code"}})
     * @param Request $request
     * @param Country $country
     * @return Response
     */
    public function edit(Request $request, Country $country)
    {
        $form = $this->createForm(EditFormType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CountryRepository $repo */
            $repo = $this->getDoctrine()->getRepository(Country::class);

            $repo->save($country);

            $this->addFlash('success', '');
        }

        return $this->render('location/country/edit.html.twig', [
            'country' => $country,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/add", name="app-location-country-add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request)
    {
        /** @var CountryRepository $repo */
        $repo = $this->getDoctrine()->getRepository(Country::class);

        $country = $repo->createNew();

        $form = $this->createForm(EditFormType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($country);

            $this->addFlash('success', '');

            $this->redirectToRoute('app-location-country-edit', ['code' => $country->getCode()], 301);
        }

        return $this->render('location/country/add.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{code}/delete", name="app-location-country-delete")
     * @ParamConverter("country", options={"mapping": {"code": "code"}})
     * @param Country $country
     * @return RedirectResponse
     */
    public function delete(Country $country)
    {
        return $this->redirectToRoute('app-location-country', [], 301);
    }
}