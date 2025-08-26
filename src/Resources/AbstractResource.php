<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources;

use BackedEnum;
use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use DateTimeInterface;

abstract class AbstractResource implements ResourceInterface
{
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: "";
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
            if ($value !== null) {
                $result[$k] = [];
                if ($value instanceof DateTimeInterface) {
                    $result[$k] = $value->format(DateTimeInterface::ATOM);
                } elseif ($value instanceof ResourceCollection && $value->count() > 0) {
                    $result[$k] = $value->toArray();
                } elseif ($value instanceof BackedEnum) {
                    $result[$k] = $value->value;
                } else {
                    $result[$k] = $value;
                }
            }
        }

        return $result;
    }

    private static function camelToSnake(string $string): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string) ?? "");
    }
}
