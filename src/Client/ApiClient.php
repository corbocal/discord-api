<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Client;

use Corbocal\DiscordApi\Client\Enums\EndpointsEnum;
use Corbocal\DiscordApi\Client\Enums\VersionsEnum;
use Corbocal\DiscordApi\Resources\Message\MessageInterface;
use GuzzleHttp\Client as HttpClient;

class ApiClient extends AbstractClient
{
    public function __construct(
        HttpClient $http,
        protected string $token,
        protected bool $isBot,
        protected VersionsEnum $version = VersionsEnum::V10
    ) {
        parent::__construct($http);
    }

    public function createMessage(
        MessageInterface $message,
        string|int $channelId = null,
    ): void {
        // $endpoint = $this->formatEndpoint(EndpointsEnum::CREATE_MESSAGE, strval($channelId));
        // $this->post($endpoint, $message->getPayload());
    }

    public function deleteMessage(
    //     string|int $channelId = null,
    //     string|int $messageId = null,
    ): void {
    //     $endpoint = $this->formatEndpoint(
    //         EndpointsEnum::DELETE_MESSAGE,
    //         strval($channelId),
    //         strval($messageId)
    //     );
        // $this->delete($endpoint);
    }
}