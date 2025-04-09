<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\User;
use App\Form\AppointmentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class AppointmentController extends AbstractController
{
    #[IsGranted("ROLE_SPECIALIST")]
    #[Route('/add/appointment', name: 'app_add_appointment')]
    public function addAppointment(Request $request, EntityManagerInterface $entityManager): Response
    {
        $appointment = new Appointment();
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form = $form->getData();
            $form->setSpecialist($this->getUser());
            $entityManager->persist($appointment);
            $entityManager->flush();

            return $this->redirectToRoute('app_specialist_home');
        }

        return $this->render('appointment/add.html.twig', [
            'form' => $form,
        ]);
    }
}
