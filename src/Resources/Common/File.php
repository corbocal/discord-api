<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Validator\Validator;

class File extends AbstractResource
{
    public function __construct(
        protected string $fullpath,
        protected ?string $filename = null,
    ) {
        Validator::fileExists($fullpath);
        $this->fullpath = (string) realpath($fullpath);
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function getFullPath(): string
    {
        return $this->fullpath;
    }
}
