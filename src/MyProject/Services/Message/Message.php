<?php

namespace MyProject\Services\Message;

/**
 * Class Message
 * @package MyProject\Services\Message
 */
class Message
{
    public const SUCCESS = 'success';
    public const WARNING = 'warning';
    public const DANGER = 'danger';
    public const INFO = 'info';

    private $text;
    private $type;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }
}