<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Message;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Resources\Message\MessageInterface;

class AbstractMessage extends AbstractResource implements MessageInterface
{
    // public function __construct(
    //     protected ?string $content = null,
    //     protected string|int|null $nonce = null,
    //     protected ?bool $tts = null,
    //     protected ?array $embeds = null,
    //     protected ?array $allowedMentions = null,
    //     protected ?array $messageReference = null,
    //     protected ?array $components = null,
    //     protected ?array $stickerIds = null,
    //     protected ?array $files = null,
    //     protected ?string $payloadJson = null,
    //     protected ?array $attachments = null,
    //     protected ?int $flags = null,
    //     protected ?bool $enforceNonce = null,
    //     protected ?array $poll = null,
    // ) {
    // }

    // public function getPayload(): array
    // {
    //     return [
    //         'content' => $this->content,
    //         'nonce' => $this->nonce,
    //         'tts' => $this->tts,
    //         'embeds' => $this->embeds,
    //         'allowed_mentions' => $this->allowedMentions,
    //         'message_reference' => $this->messageReference,
    //         'components' => $this->components,
    //         'sticker_ids' => $this->stickerIds,
    //         'files' => $this->files,
    //         'payload_json' => $this->payloadJson,
    //         'attachments' => $this->attachments,
    //         'flags' => $this->flags,
    //         'enforce_nonce' => $this->enforceNonce,
    //         'poll' => $this->poll,
    //     ];
    // }

    // public function setContent(?string $content): self
    // {
    //     $this->content = $content;
    //     return $this;
    // }

    // public function getContent(): ?string
    // {
    //     return $this->content;
    // }

    // public function setNonce(string|int|null $nonce): self
    // {
    //     $this->nonce = $nonce;
    //     return $this;
    // }

    // public function getNonce(): string|int|null
    // {
    //     return $this->nonce;
    // }

    // public function setTts(?bool $tts): self
    // {
    //     $this->tts = $tts;
    //     return $this;
    // }

    // public function getTts(): ?bool
    // {
    //     return $this->tts;
    // }

    // public function setEmbeds(?array $embeds): self
    // {
    //     $this->embeds = $embeds;
    //     return $this;
    // }

    // public function getEmbeds(): ?array
    // {
    //     return $this->embeds;
    // }

    // public function setAllowedMentions(?array $allowedMentions): self
    // {
    //     $this->allowedMentions = $allowedMentions;
    //     return $this;
    // }

    // public function getAllowedMentions(): ?array
    // {
    //     return $this->allowedMentions;
    // }

    // public function setMessageReference(?array $messageReference): self
    // {
    //     $this->messageReference = $messageReference;
    //     return $this;
    // }

    // public function getMessageReference(): ?array
    // {
    //     return $this->messageReference;
    // }

    // public function setComponents(?array $components): self
    // {
    //     $this->components = $components;
    //     return $this;
    // }

    // public function getComponents(): ?array
    // {
    //     return $this->components;
    // }

    // public function setStickerIds(?array $stickerIds): self
    // {
    //     $this->stickerIds = $stickerIds;
    //     return $this;
    // }

    // public function getStickerIds(): ?array
    // {
    //     return $this->stickerIds;
    // }

    // public function setFiles(?array $files): self
    // {
    //     $this->files = $files;
    //     return $this;
    // }

    // public function getFiles(): ?array
    // {
    //     return $this->files;
    // }

    // public function setPayloadJson(?string $payloadJson): self
    // {
    //     $this->payloadJson = $payloadJson;
    //     return $this;
    // }

    // public function getPayloadJson(): ?string
    // {
    //     return $this->payloadJson;
    // }

    // public function setAttachments(?array $attachments): self
    // {
    //     $this->attachments = $attachments;
    //     return $this;
    // }

    // public function getAttachments(): ?array
    // {
    //     return $this->attachments;
    // }

    // public function setFlags(?int $flags): self
    // {
    //     $this->flags = $flags;
    //     return $this;
    // }

    // public function getFlags(): ?int
    // {
    //     return $this->flags;
    // }

    // public function setEnforceNonce(?bool $enforceNonce): self
    // {
    //     $this->enforceNonce = $enforceNonce;
    //     return $this;
    // }

    // public function getEnforceNonce(): ?bool
    // {
    //     return $this->enforceNonce;
    // }

    // public function setPoll(?array $poll): self
    // {
    //     $this->poll = $poll;
    //     return $this;
    // }

    // public function getPoll(): ?array
    // {
    //     return $this->poll;
    // }
}
