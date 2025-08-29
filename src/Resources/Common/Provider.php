<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\AbstractResource;

class Provider extends AbstractResource
{
    public function __construct(
        protected ?string $name = null,
        protected ?string $url = null,
    ) {
    }
}
