<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources;

use Corbocal\DiscordApi\Resources\Common\File;

interface ResourceFilesInterface extends ResourceInterface
{
    public function hasFiles(): bool;

    /**
     * @return ?File[]
     */
    public function getFiles(): ?array;
}
