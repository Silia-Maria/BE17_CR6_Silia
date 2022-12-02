<?php

namespace App\Controller;

use App\Form\EventType;
use App\Entity\Events;
use App\Entity\Organisers;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{
    # index
    #[Route('/events', name: 'events')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $events = $doctrine->getRepository(Events::class)->findAll();
        return $this->render('events/index.html.twig', [
            'events' => $events,
        ]);
    }

    #create
    #[Route('/create', name: 'create')]
    public function create(ManagerRegistry $doctrine, Request $request): Response
    {
        $event = new Events();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $event = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('events');
        }

        return $this->render('events/create.html.twig', [
            'form' => $form,
        ]);
    }

    #edit
    #[Route('/edit/{id}', name: 'edit')]
    public function edit($id, ManagerRegistry $doctrine, Request $request): Response
    {
        $event = $doctrine->getRepository(Events::class)->find($id);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $event = $form->getData();
            $em = $doctrine->getManager();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('events');
        }
        return $this->render('events/edit.html.twig', [
            'form' => $form,
            'event' => $event,
        ]);
    }

    #details
    #[Route('/details/{id}', name: 'details')]
    public function details($id, ManagerRegistry $doctrine): Response
    {
        $event = $doctrine->getRepository(Events::class)->find($id);
        $fk_organizer = $event->getFkOrganizer()->getId();
        $organizer = $doctrine->getRepository(Organisers::class)->find($fk_organizer);

        return $this->render('events/details.html.twig', [
            'event' => $event,
            'organizer' => $organizer,

        ]);
    }

    #delete
    #[Route('/delete/{id}', name: 'detelete')]
    public function delete($id, ManagerRegistry $doctrine): Response
    {
        $event = $doctrine->getRepository(Events::class)->find($id);
        $em = $doctrine->getManager();
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('events');
    }
}
