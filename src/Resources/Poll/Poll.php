<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Poll;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Resources\Poll\PollAnswer;
use Corbocal\DiscordApi\Resources\Poll\PollQuestion;
use Corbocal\DiscordApi\Validator\Validator;

class Poll extends AbstractResource
{
    /**
     * @var ?ResourceCollection<int, PollAnswer>
     */
    protected ?ResourceCollection $answers = null;

    public function __construct(
        protected PollQuestion $question,
        protected ?int $duration = null,
        protected ?bool $allowMultiselect = null,
        // protected ?int $layoutType = null,
    ) {
        Validator::pollDuration($duration);
    }

    public function addAnswer(
        string $text,
        ?string $emoji = null
    ): self {
        Validator::pollMaxAnswerNumber($this->answers);
        if ($this->answers === null) {
            $this->answers = new ResourceCollection();
        }
        $answer = new PollAnswer(
            count($this->answers) + 1,
            new PollMedia($text, $emoji)
        );
        $this->answers->append($answer);

        return $this;
    }
}
