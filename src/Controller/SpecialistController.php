<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class SpecialistController extends AbstractController
{
    #[IsGranted('ROLE_SPECIALIST')]
    #[Route('/specialist', name: 'app_specialist_home')]
    public function index(): Response
    {
        return $this->render('specialist/index.html.twig', [
        ]);
    }
}
