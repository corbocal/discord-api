<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Validator\Validator;

class FieldDto extends AbstractResource
{
    public function __construct(
        protected string $name,
        protected string $value,
        protected ?bool $inline = null
    ) {
        Validator::fieldNameLength($name);
        Validator::fieldValueLength($value);
    }
}
