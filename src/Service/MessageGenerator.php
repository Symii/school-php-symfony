<?php
// src/Service/MessageGenerator.php
namespace App\Service;

class MessageGenerator
{
    public function getHappyMessage(): string
    {
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }

    public function getRandomChallenge(): string
    {
        $messages = [
            '50 Push-ups',
            'Run 10km',
            '20 pull-ups',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
}