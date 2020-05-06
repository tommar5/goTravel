<?php
namespace App\Controller\User;

use App\Entity\User;
use App\Form\User\UserEditType;
use App\Repository\User\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/users")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="app-users-list")
     * @return Response
     */
    public function index()
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/{id}/view", name="app-user-view")
     * @param User $user
     * @return Response
     */
    public function viewAction(User $user)
    {
        return $this->render('user/view.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app-user-edit")
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function editAction(Request $request, User $user)
    {
        $form = $this->createForm(new UserEditType(), $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UserRepository $repo */
            $repo = $this->getDoctrine()->getRepository(User::class);
            $user = $repo->update($user);

            $this->addFlash('success', 'flashes.user.edit.success');
            return $this->redirectToRoute('app-user-view', ['id' => $user->getId()], 200);
        }

        return $this->render('user\edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/add", name="app-user-add")
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        /** @var UserRepository $repo */
        $repo = $this->getDoctrine()->getRepository(User::class);

        $user = $repo->createNew();

        $form = $this->createForm(new UserEditType(), $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $repo->save($user);

            $this->addFlash('success', 'flashes.user.add.success');
            return $this->redirectToRoute('app-user-view', ['id' => $user->getId()], 200);
        }

        return $this->render('user\edit.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="app-user-delete")
     * @param User $user
     * @return Response
     */
    public function deleteAction(User $user)
    {
        return $this->redirectToRoute('app-users-list');
    }
}