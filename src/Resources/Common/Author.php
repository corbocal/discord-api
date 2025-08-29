<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Validator\Validator;

class Author extends AbstractResource
{
    public function __construct(
        protected string $name,
        protected ?string $url = null,
        protected ?string $iconUrl = null,
        // protected ?string $proxyIconUrl = null,
    ) {
        Validator::fieldNameLength($name);
    }
}
