<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class PatientController extends AbstractController
{
    #[IsGranted('ROLE_PATIENT')]
    #[Route('/patient', name: 'app_patient_home')]
    public function index(): Response
    {
        return $this->render('patient/index.html.twig', [
        ]);
    }
}
