<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources;

use Corbocal\DiscordApi\Resources\Common\FileDto;

interface ResourceInterface
{
    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    public function toJson(): string;

    public function hasFiles(): bool;

    /**
     * @return FileDto[]
     */
    public function getFiles(): ?array;
}