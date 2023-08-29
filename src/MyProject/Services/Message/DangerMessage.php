<?php

namespace MyProject\Services\Message;

/**
 * Class DangerMessage
 * @package MyProject\Services\Message
 */
final class DangerMessage extends Message
{
    public function __construct(string $text)
    {
        parent::__construct($text);
        $this->setType(Message::DANGER);
    }
}
