<?php

declare(strict_types=1);

namespace Users\Controller;

use Users\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class DefaultController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): Response
    {
        $users = [];
        if ($request->query->has('attribute')) {
            $users = $this->entityManager
                ->getRepository(User::class)
                ->findUsersByAttributeName($request->get('attribute'));
        }

        return $this->render('Default/index.html.twig', array(
            'users' => $users,
        ));
    }
}