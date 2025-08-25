<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources;

use Corbocal\DiscordApi\Resources\Classes\ObjectCollection;
use BackedEnum;
use DateTimeInterface;
use SplFileObject;

abstract class AbstractResource implements ResourceInterface
{
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    public function toArray(): array
    {
        $result = [];
        $vars = get_object_vars($this);
        foreach ($vars as $key => $value) {
            if ($key === "files") {
                continue;
            }
            $k = self::camelToSnake($key);
            if ($value instanceof DateTimeInterface) {
                $result[$k] = $value->format(DateTimeInterface::ATOM);
                continue;
            }
            if ($value instanceof ObjectCollection && $value->count() > 0) {
                foreach ($value as $offset => $object) {
                    if ($object instanceof ResourceInterface) {
                        $result[$k][$offset] = $object->toArray();
                    } else {
                        if ($value !== null) {
                            $result[$k] = $value;
                        }
                    }
                }
                continue;
            }
            if ($value instanceof BackedEnum) {
                $result[$k] = $value->value;
                continue;
            }
            if ($value !== null) {
                $result[$k] = $value;
            }
        }

        return $result;
    }

    private static function camelToSnake(string $string): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }

    public function hasFiles(): bool
    {
        return isset($this->files);
    }

    public function getFiles(): ?array
    {
        $result = null;
        if (isset($this->files) && $this->files instanceof ObjectCollection) {
            foreach ($this->files as $file) {
                $result[] = $file;
            }
        }
        return $result;
    }
}