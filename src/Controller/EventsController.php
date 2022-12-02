<?php

namespace App\Controller;

use App\Entity\Events;
use App\Entity\Organisers;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{
    # index
    #[Route('/events', name: 'app_events')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $events = $doctrine->getRepository(Events::class)->findAll();
        return $this->render('events/index.html.twig', [
            'events' => $events,
        ]);
    }

    #create
    #[Route('/create', name: 'create')]
    public function create(): Response
    {
        return $this->render('events/create.html.twig', []);
    }

    #edit
    #[Route('/edit/{id}', name: 'edit')]
    public function edit($id): Response
    {
        return $this->render('events/edit.html.twig', []);
    }

    #details
    #[Route('/details/{id}', name: 'details')]
    public function details($id): Response
    {
        return $this->render('events/details.html.twig', []);
    }

    #delete
    #[Route('/delete/{id}', name: 'detelete')]
    public function delete($id): Response
    {
        return $this->render('events/delete.html.twig', []);
    }
}
