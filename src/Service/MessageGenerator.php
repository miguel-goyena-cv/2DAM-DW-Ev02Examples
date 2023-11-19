<?php
namespace App\Service;

class MessageGenerator
{
    public function getHappyMessage(): string
    {
        $messages = 'You did it! You created and used the first service!' ;

        return $messages;
    }
}