<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources;

interface ResourceInterface
{
    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    public function toJson(): string;
}
