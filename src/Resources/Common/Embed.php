<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\Enums\EmbedTypeEnums;
use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Validator\Validator;
use DateTimeInterface;

class Embed extends AbstractResource
{
    /**
     * @var ?ResourceCollection<int, Field>
     */
    protected ?ResourceCollection $fields = null;

    public function __construct(
        protected ?string $title = null,
        protected ?EmbedTypeEnums $type = null,
        protected ?string $description = null,
        protected ?string $url = null,
        protected ?DateTimeInterface $timestamp = null,
        protected ?string $color = null,
        // protected ?string $footer,
        // protected ?string $image,
        // protected ?string $thumbnail,
        // protected ?string $video,
        // protected ?string $provider,
        // protected ?string $author,
        // Objects to create
    ) {
        Validator::color($color);
        if ($color !== null) {
            $this->color = (string) hexdec(ltrim($color, "#"));
        }
    }

    public function getType(): ?EmbedTypeEnums
    {
        return $this->type;
    }

    public function addField(Field $field): self
    {
        Validator::fieldsdMaxNumberInEmbed($this->fields);
        if ($this->fields === null) {
            $this->fields = new ResourceCollection();
        }
        $this->fields->append($field);

        return $this;
    }
}
