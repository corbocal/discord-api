<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Poll;

use Corbocal\DiscordApi\Resources\AbstractResource;

class PollAnswer extends AbstractResource
{
    public function __construct(
        protected int $answerId,
        protected PollMedia $pollMedia
    ) {
    }
}
