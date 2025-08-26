<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Exceptions;

use Corbocal\DiscordApi\Exceptions\DiscordException;

class ValidationException extends DiscordException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 500);
    }
}
