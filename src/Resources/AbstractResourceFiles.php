<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources;

use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Resources\Common\File;

abstract class AbstractResourceFiles extends AbstractResource implements ResourceFilesInterface
{
    /**
     * @var ResourceCollection<int, File>
     */
    protected ?ResourceCollection $files = null;

    public function hasFiles(): bool
    {
        return $this->files?->count() > 0;
    }

    /**
     * @return array<int,File>|null
     */
    public function getFiles(): ?array
    {
        $result = null;
        if ($this->hasFiles()) {
            foreach ($this->files ?: [] as $key => $file) {
                /**
                 * @var File
                 */
                $file = $file;
                $result[$key] = $file;
            }
        }

        return $result;
    }
}
