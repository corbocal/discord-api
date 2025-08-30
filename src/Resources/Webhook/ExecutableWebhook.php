<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Webhook;

use Corbocal\DiscordApi\Exceptions\ValidationException;
use Corbocal\DiscordApi\Resources\AbstractResourceFiles;
use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Resources\Common\AllowedMentions;
use Corbocal\DiscordApi\Resources\Common\Embed;
use Corbocal\DiscordApi\Resources\Common\File;
use Corbocal\DiscordApi\Resources\ComponentInterface;
use Corbocal\DiscordApi\Resources\Poll\Poll;
use Corbocal\DiscordApi\Validator\Validator;

class ExecutableWebhook extends AbstractResourceFiles implements WebhookResourceInterface
{
    protected ?string $content = null;

    /**
     * @var ?ResourceCollection<int, Embed>
     */
    protected ?ResourceCollection $embeds = null;

    protected ?Poll $poll = null;

    /**
     * @var ComponentInterface[]
     */
    protected ?array $components = null;

    /**
     * Summary of __construct
     * @param ?string $username
     * @param ?string $avatarUrl
     * @param ?AllowedMentions $allowedMentions
     * @param ?bool $tts
     * @param ?int $flags
     * @param ?string $treadName
     * @param ?array<int, string> $appliedTags
     */
    public function __construct(
        protected ?string $username = null,
        protected ?string $avatarUrl = null,
        // protected ?array $attachments = null,
        protected ?AllowedMentions $allowedMentions = null,
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
            throw new ValidationException("The Webhook Ressource needs to have at least one item among:
                . `content`, `embeds`, `files` or `poll` to be sent.");
        }
    }

    public function withContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function addEmbed(Embed $embed): self
    {
        Validator::embedTypeIsRichForWebhook($embed);
        Validator::embedMaxNumber($this->embeds);
        if ($this->embeds === null) {
            $this->embeds = new ResourceCollection();
        }
        $this->embeds->append($embed);

        return $this;
    }

    public function withEmbeds(Embed ...$embeds): self
    {
        foreach ($embeds as $embed) {
            $this->addEmbed($embed);
        }

        return $this;
    }

    public function addFile(File $file): self
    {
        Validator::filesMaxNumber($this->files);
        if ($this->files === null) {
            $this->files = new ResourceCollection();
        }
        $this->files->append($file);

        return $this;
    }

    public function withFiles(File ...$files): self
    {
        foreach ($files as $file) {
            $this->addFile($file);
        }

        return $this;
    }

    public function withPoll(Poll $poll): self
    {
        $this->poll = $poll;

        return $this;
    }

    // public function addComponent(string $component): self
    // {
    //     $this->components[] = $component;

    //     return $this;
    // }

    // public function withComponents(Component ...$components): self
    // {
    //     $this->components = $components;

    //     return $this;
    // }
}
