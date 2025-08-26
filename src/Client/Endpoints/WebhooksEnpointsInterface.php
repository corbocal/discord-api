<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Client\Endpoints;

use Corbocal\DiscordApi\Resources\Webhook\ExecutableWebhook;

interface WebhooksEnpointsInterface
{
    public function execute(
        ExecutableWebhook $webhookRessource,
        ?bool $wait = null,
        ?string $threadId = null,
        ?bool $withComponents = null
    );
}