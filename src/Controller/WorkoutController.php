<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Service\MessageGenerator;

class WorkoutController extends AbstractController
{
    #[Route('/workout', name:'workout')]
    public function new(MessageGenerator $messageGenerator): Response
    {
        $challenge = $messageGenerator->getRandomChallenge();
        return $this->render('workout/challenges.html.twig', [
            'challenge' => $challenge,
        ]);
    }
}