<?php

declare(strict_types=1);

namespace Users\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Users\Service\UserManager;

class GetUsersController extends AbstractController
{
    public function __invoke(Request $request, UserManager $userManager): Response
    {
        $users = [];
        if ($request->query->has('attribute')) {
            $users = $userManager->findUsersByAttribute($request->get('attribute'));
        }

        return $this->render('Users/index.html.twig', array(
            'users' => $users,
            'term' => $request->get('attribute'),
        ));
    }
}