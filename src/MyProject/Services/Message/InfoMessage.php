<?php

namespace MyProject\Services\Message;

/**
 * Class InfoMessage
 * @package MyProject\Services\Message
 */
final class InfoMessage extends Message
{
    public function __construct(string $text)
    {
        parent::__construct($text);
        $this->setType(Message::INFO);
    }
}
