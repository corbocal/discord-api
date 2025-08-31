<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Resources\Enums\TypesEnums;

class SelectDefault extends AbstractResource
{
    /**
     * Summary of __construct
     * @param int $id snowflake of a user, role or channel.
     * @param TypesEnums $type either "role", "user" or "channel".
     */
    public function __construct(
        protected int $id,
        protected TypesEnums $type,
    ) {
    }
}
