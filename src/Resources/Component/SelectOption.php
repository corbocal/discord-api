<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Resources\Component\Interfaces\ChildSelectInterface;
use Corbocal\DiscordApi\Resources\Emoji\PartialEmoji;

class SelectOption extends AbstractResource implements ChildSelectInterface
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
