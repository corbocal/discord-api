<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\AbstractResource;

class AbstractMedia extends AbstractResource
{
    public function __construct(
        protected string $url,
        protected ?string $proxyUrl = null,
        protected ?int $height = null,
        protected ?int $width = null,
    ) {
    }
}
