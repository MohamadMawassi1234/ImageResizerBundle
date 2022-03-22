<?php

// src/Service/MessageGenerator.php
namespace MyBundle\ImageResizerBundle\Provider;

// use App\Service\MessageType;

class MessageGenerator
{

    
    public function getHappyMessage()
    {

        $message = 'You did it! You updated the system! Amazing!';

        // $index = array_rand($messages);

        return $message;
    }
}