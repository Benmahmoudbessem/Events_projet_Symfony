<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/', name: 'app_event_list')]
    public function listEvents(EventRepository $er): Response
    {
        $listEvents = $er->findAll();
        return $this->render('event/listEvents.html.twig', [
            'listE' => $listEvents
        ]);
    }

    #[Route('/new', name: 'app_event_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('app_event_list');
        }

        return $this->render('event/new.html.twig', [
            'formE' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'event_delete')]
    public function delete(EntityManagerInterface $em, EventRepository $er, int $id): Response
    {
        $event = $er->find($id);

        if (!$event) {
            throw $this->createNotFoundException('Event not found');
        }

        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('app_event_list');
    }

    #[Route('/edit/{id}', name: 'event_update')]
    public function edit(Request $request, EntityManagerInterface $em, EventRepository $er, int $id): Response
    {
        $event = $er->find($id);

        if (!$event) {
            throw $this->createNotFoundException('Event not found');
        }

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('app_event_list');
        }

        return $this->render('event/edit.html.twig', [
            'formE' => $form->createView()
        ]);
    }
#[Route('/search', name: 'searchE')]
public function searchEvent(Request $r, EntityManagerInterface $em)
{

    $nom = $r->request->get('eventName');
    $q= $em-> createQuery('select e from App\Entity\Event e  where e.nom= :n');
    $q-> setParameter('n', $nom);
    $events=$q->getArrayResult();
    return $this->render('event/searchEvent.html.twig',["listeE"=>$events]);
}



}
