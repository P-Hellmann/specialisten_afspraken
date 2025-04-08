<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, Security $security): Response
    {
        if ($this->isGranted('ROLE_PATIENT')) {
            return $this->redirectToRoute('app_patient_home');
        }
        if ($this->isGranted('ROLE_SPECIALIST')) {
            return $this->redirectToRoute('app_specialist_home');
        }
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin_home');
        }
        return $this->render('home/index.html.twig', [
        ]);
    }
}
