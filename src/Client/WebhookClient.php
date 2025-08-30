<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Client;

use Corbocal\DiscordApi\Client\Endpoints\WebhooksEnpointsInterface;
use Corbocal\DiscordApi\Resources\Webhook\ExecutableWebhook;
use GuzzleHttp\Client as HttpClient;

class WebhookClient extends AbstractClient implements WebhooksEnpointsInterface
{
    public const string WEBHOOKS = "/webhooks";

    public function __construct(
        HttpClient $http,
        protected readonly string $webhookId = '',
        protected readonly string $webhookToken = ''
    ) {
        parent::__construct($http);
    }

    public function execute(
        ExecutableWebhook $resource,
        ?bool $wait = null,
        ?string $threadId = null,
        ?bool $withComponents = null,
    ): void {
        $resource->check();
        $uri = self::WEBHOOKS . "/" . $this->webhookId . "/" . $this->webhookToken;
        $this->post($uri, $resource);
    }
}
