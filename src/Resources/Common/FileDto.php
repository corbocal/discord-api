<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Validator\Validator;

class FileDto extends AbstractResource
{
    public function __construct(
        protected string $filename,
        protected string $fullpath
    ) {
        Validator::fileExists($fullpath);
        $this->fullpath = realpath($fullpath);
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getFullPath(): string
    {
        return $this->fullpath;
    }
}
