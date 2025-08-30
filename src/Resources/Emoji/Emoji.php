<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Emoji;

use Corbocal\DiscordApi\Resources\Emoji\PartialEmoji;

class Emoji extends PartialEmoji
{
    public function __construct(
        string $name,
        int $id,
        ?bool $animated = null,
    ) {
        parent::__construct($name, $id, $animated);
    }
}
