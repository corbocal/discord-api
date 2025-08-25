<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Webhook;

use Corbocal\DiscordApi\Exceptions\ValidationException;
use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Resources\Classes\ObjectCollection;
use Corbocal\DiscordApi\Resources\Common\AllowedMentionsDto;
use Corbocal\DiscordApi\Resources\Common\ComponentDto;
use Corbocal\DiscordApi\Resources\Common\EmbedDto;
use Corbocal\DiscordApi\Resources\Common\FileDto;
use Corbocal\DiscordApi\Resources\Poll\PollDto;
use Corbocal\DiscordApi\Validator\Validator;

class ExecuteWebhookDto extends AbstractResource implements WebhookResourceInterface
{
    protected ?string $content = null;

    /**
     * @var ?ObjectCollection<EmbedDto>
     */
    protected ?ObjectCollection $embeds = null;

    /**
     * @var ?ObjectCollection<FileDto>
     */
    protected ?ObjectCollection $files = null;

    protected ?PollDto $poll = null;

    /**
     * @var ComponentDto[]
     */
    protected ?array $components = null;

    public function __construct(
        protected ?string $username = null,
        protected ?string $avatarUrl = null,
        protected ?array $attachments = null,
        protected ?AllowedMentionsDto $allowedMentions = null,
        protected ?bool $tts = null,
        protected ?int $flags = null,
        protected ?string $treadName = null,
        protected ?array $appliedTags = null,
    ) {
        Validator::webhookName($username);
    }

    public function check(): void
    {
        if (
            empty($this->content)
            && empty($this->embeds)
            && empty($this->files)
            && empty($this->poll)
            && empty($this->components)
        ) {
            throw new ValidationException("The Webhook Ressource needs to have at least one item among `content`, `embeds`, `files` or `poll` to be sent.");
        }
    }

    public function withContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function addEmbed(EmbedDto $embed): self
    {
        Validator::embedTypeIsRichForWebhook($embed);
        Validator::embedMaxNumber($this->embeds);
        if ($this->embeds === null) {
            $this->embeds = new ObjectCollection();
        }
        $this->embeds->append($embed);

        return $this;
    }

    public function withEmbeds(EmbedDto ...$embeds): self
    {
        foreach ($embeds as $embed) {
            $this->addEmbed($embed);
        }

        return $this;
    }

    public function getLastEmbed(): ?EmbedDto
    {
        $result = null;
        if (!empty($this->embeds)) {
            $result = $this->embeds[$this->embeds->count() - 1];
        }

        return $result;
    }

    public function addFile(FileDto $file): self
    {
        Validator::filesMaxNumber($this->files);
        if ($this->files === null) {
            $this->files = new ObjectCollection();
        }
        $this->files->append($file);

        return $this;
    }

    public function withFiles(FileDto ...$files): self
    {
        foreach ($files as $file) {
            $this->addFile($file);
        }

        return $this;
    }

    // public function withPoll(Poll $poll): self
    // {
    //     $this->poll = $poll;

    //     return $this;
    // }

    // public function addComponent(string $component): self
    // {
    //     $this->components[] = $component;

    //     return $this;
    // }

    // public function withComponents(ComponentDto ...$components): self
    // {
    //     $this->components = $components;

    //     return $this;
    // }
}