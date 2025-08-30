<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Resources\Common\Field;
use Corbocal\DiscordApi\Resources\Emoji\PartialEmoji;

class SelectOption extends AbstractResource
{
    public function __construct(
        protected string $label,
        protected string $value,
        // protected ?PartialEmoji $emoji,
        protected ?string $description = null,
        protected ?bool $default = null,
    ) {
    }
}
