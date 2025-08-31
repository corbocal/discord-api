<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Webhook;

use Corbocal\DiscordApi\Resources\ResourceInterface;

interface WebhookResourceInterface extends ResourceInterface
{
    public function check(): void;
}
