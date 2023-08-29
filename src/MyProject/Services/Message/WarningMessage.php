<?php

namespace MyProject\Services\Message;

/**
 * Class WarningMessage
 * @package MyProject\Services\Message
 */
final class WarningMessage extends Message
{
    public function __construct(string $text)
    {
        parent::__construct($text);
        $this->setType(Message::WARNING);
    }
}
