<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Client;

use Corbocal\DiscordApi\Exceptions\DiscordException;
use Corbocal\DiscordApi\Exceptions\HttpClientException;
use Corbocal\DiscordApi\Resources\ResourceFilesInterface;
use Corbocal\DiscordApi\Resources\ResourceInterface;
use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Utils;

abstract class AbstractClient
{
    /**
     * @var array<string,string>
     */
    protected array $headers;

    public function __construct(
        protected readonly HttpClient $http
    ) {
    }

    /**
     * @param string $method
     * @param string $uri
     * @param ResourceInterface|ResourceFilesInterface|null $payload
     *
     * @throws DiscordException When the request could be requestd but Discord returned an Http error code
     * @throws HttpClientException When the request could not be requestd
     *
     * @return void
     */
    private function request(string $method, string $uri, ResourceInterface|ResourceFilesInterface|null $payload = null): void
    {
        $uri = ltrim($uri, "/");
        try {
            $options = [];
            // $this->addHeaderFormMultipart();
            empty($this->headers) ?: $options['headers'] = $this->headers;
            $payload = $this->handlePayload($payload);
            empty($payload) ?: $options = array_merge($options, $payload);

            $response = $this->http->request(
                $method,
                $uri,
                $options
            );

            $code = $response->getStatusCode();
            if (!($code >= 200 && $code < 300)) {
                $responseBody = $response->getBody()->__tostring();
                throw new DiscordException($responseBody, $code);
            }
        } catch (Exception $e) {
            throw new HttpClientException(
                "Caught " . get_class($e) . " code : " . $e->getCode() . " " . $e->getMessage(),
                500,
                $e
            );
        }
    }

    /**
     *
     * @return array<mixed>
     */
    private function handlePayload(ResourceInterface|ResourceFilesInterface|null $resource): array
    {
        $payload = [];
        if ($resource !== null) {
            if ($resource instanceof ResourceFilesInterface && $resource->hasFiles()) {
                $result = [];
                $iterator = 0;
                $files = $resource->getFiles();
                foreach ($files ?? [] as $file) {
                    $extension = substr($file->getFullPath(), strripos($file->getFullPath(), ".") ?: 0);
                    $upload = [
                        'name' => "files[$iterator]",
                        'filename' => rtrim($file->getFilename() ?? "file$iterator", $extension) . $extension,
                        'contents' => Utils::tryFopen($file->getFullPath(), 'r'),
                    ];
                    $iterator++;
                    $result[] = $upload;
                }

                if (!empty($resource->toArray())) {
                    $result[] = [
                        'name' => 'payload_json',
                        'contents' => $resource->toJson()
                    ];
                }
                $payload['multipart'] = $result;
            } else {
                $payload['json'] = $resource->toArray();
            }
        }


        return $payload;
    }

    public function addHeaders(string $name, string $value): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    public function addHeaderJson(): self
    {
        $this->headers['Content-Type'] = 'application/json';

        return $this;
    }

    public function addHeaderFormMultipart(): self
    {
        $this->headers['Content-Type'] = 'multipart/form-data';

        return $this;
    }

    /**
     * @param string $uri
     * @param array<mixed> $queryStringParams
     * @return void
     */
    protected function get(string $uri, array $queryStringParams = []): void
    {
        $this->request("GET", $uri);
    }

    /**
     * @param string $uri
     * @param ResourceInterface|ResourceFilesInterface|null $payload
     * @param array<mixed> $queryStringParams
     * @return void
     */
    protected function post(string $uri, ResourceInterface|ResourceFilesInterface|null $payload = null, array $queryStringParams = []): void
    {
        $this->request("POST", $uri, $payload);
    }

    /**
     * @param string $uri
     * @param ResourceInterface|ResourceFilesInterface|null $payload
     * @param array<mixed> $queryStringParams
     * @return void
     */
    protected function patch(string $uri, ResourceInterface|ResourceFilesInterface|null $payload = null, array $queryStringParams = []): void
    {
        $this->request("PATCH", $uri, $payload);
    }

    /**
     * @param string $uri
     * @param ResourceInterface|ResourceFilesInterface|null $payload
     * @param array<mixed> $queryStringParams
     * @return void
     */
    protected function put(string $uri, ResourceInterface|ResourceFilesInterface|null $payload = null, array $queryStringParams = []): void
    {
        $this->request("PUT", $uri, $payload);
    }

    /**
     * @param string $uri
     * @param ResourceInterface|ResourceFilesInterface|null $payload
     * @param array<mixed> $queryStringParams
     * @return void
     */
    protected function delete(string $uri, ResourceInterface|ResourceFilesInterface|null $payload = null, array $queryStringParams = []): void
    {
        $this->request("DELETE", $uri, $payload);
    }
}
