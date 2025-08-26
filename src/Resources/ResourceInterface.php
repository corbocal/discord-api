<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources;

use Corbocal\DiscordApi\Resources\Common\File;

interface ResourceInterface
{
    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    public function toJson(): string;

    public function hasFiles(): bool;

    /**
     * @return File[]
     */
    public function getFiles(): ?array;
}