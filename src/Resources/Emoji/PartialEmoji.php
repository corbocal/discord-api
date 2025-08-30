<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Emoji;

use Corbocal\DiscordApi\Resources\AbstractResource;

class PartialEmoji extends AbstractResource
{
    public function __construct(
        protected string $name,
        protected int $id,
        protected ?bool $animated = null,
    ) {
    }
}
