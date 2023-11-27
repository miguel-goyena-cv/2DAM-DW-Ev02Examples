<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Activity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class ActivityController extends AbstractController
{
    #[Route('/activity', name: 'create_activity', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, LoggerInterface $logger): JsonResponse
    {
        $logger->debug('Request: '.$request->getContent());
        $activity = new Activity();
        $activity->setType('BodyPump');
        $activity->setMonitor('Miguel Goyena');
        $activity->setPlace("Aula02");
        $activity->setDate(date_create());

        $errors = $validator->validate($activity);

        if (count($errors) > 0) {
            $logger->error('Errores: '.$errors);
            return $this->json($errors, 400);
        }

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($activity);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->json($activity);

        //return new Response('Saved new activity with id '.$activity->getId());
    }

    #[Route('/activity', name: 'get_activities', methods: ['GET'])]
    public function getAll(EntityManagerInterface $entityManager): JsonResponse
    {
        $activities = $entityManager->getRepository(Activity::class)->findAll();

        return $this->json($activities);
    }
}
