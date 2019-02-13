<?php

class DummyOutput extends AbstractOutput
{
    private $messages = [];

    public function write($message, $level)
    {
        $this->messages[] = $message;
    }

    public function getMessages()
    {
        return $this->messages;
    }
}
