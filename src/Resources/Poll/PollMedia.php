<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Poll;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Resources\Emoji\PartialEmoji;
use Corbocal\DiscordApi\Validator\Validator;

class PollMedia extends AbstractResource
{
    public function __construct(
        protected string $text,
        // protected ?PartialEmoji $emoji = null,
    ) {
        if ($this instanceof PollQuestion) {
            Validator::pollQuestionTextMaxLength($text);
        } else {
            Validator::pollAnswerTextMaxLength($text);
        }
    }
}
