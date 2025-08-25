<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Client;

use Corbocal\DiscordApi\Client\Enums\VersionsEnum;
use Corbocal\DiscordApi\Validator\Validator;
use GuzzleHttp\Client as HttpClient;

class DiscordClient
{
    public const string BASE_URL = "https://discord.com/api";
    private const string BEARER = "Bearer ";
    private const string BOT = "Bot ";

    private function __construct()
    {
    }

    private static function prepareHttpClient(string $uri): HttpClient
    {
        return new HttpClient([
            'base_uri' => $uri,
            'http_errors' => false
        ]);
    }

    public static function getWebhookClient(string $fullWebhook): WebhookClient
    {
        Validator::fullWebhook($fullWebhook);
        $elements = explode("/", $fullWebhook);
        return new WebhookClient(
            self::prepareHttpClient(self::BASE_URL . WebhookClient::WEBHOOKS),
            $elements[5],
            $elements[6]
        );
    }

    public static function getApiClient(
        string $token,
        bool $isBot,
        VersionsEnum $version = VersionsEnum::V10
    ): ApiClient {
        $isBot ? $authorizationHeader = self::BOT : $authorizationHeader = self::BEARER;
        $authorizationHeader .= $token;
        $client = new ApiClient(
            self::prepareHttpClient(self::BASE_URL . $version->value),
            $token,
            $isBot,
            $version
        );
        $client->addHeaders("authorization", $authorizationHeader);

        return $client;
    }
}
