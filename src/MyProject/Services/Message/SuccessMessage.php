<?php

namespace MyProject\Services\Message;

/**
 * Class SuccessMessage
 * @package MyProject\Services\Message
 */
final class SuccessMessage extends Message
{
    public function __construct(string $text)
    {
        parent::__construct($text);
        $this->setType(Message::SUCCESS);
    }
}
