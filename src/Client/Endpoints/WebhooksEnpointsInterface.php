<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Client\Endpoints;

use Corbocal\DiscordApi\Resources\Webhook\ExecuteWebhookDto;

interface WebhooksEnpointsInterface
{
    public function execute(
        ExecuteWebhookDto $webhookRessource,
        ?bool $wait = null,
        ?string $threadId = null,
        ?bool $withComponents = null
    );
}