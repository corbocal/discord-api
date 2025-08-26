<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\Enums\EmbedTypeEnums;
use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Resources\Classes\ObjectCollection;
use Corbocal\DiscordApi\Validator\Validator;
use DateTimeInterface;

class Embed extends AbstractResource
{
    /**
     * @var ?ObjectCollection<Field>
     */
    protected ?ObjectCollection $fields = null;

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

        // que des objets à créer
    ) {
        Validator::color($color);
        $this->color = (string) hexdec(ltrim($color, "#"));
    }

    public function getType(): ?EmbedTypeEnums
    {
        return $this->type;
    }

    public function addField(Field $field): self
    {
        Validator::fieldsdMaxNumberInEmbed($this->fields);
        if ($this->fields === null) {
            $this->fields = new ObjectCollection();
        }
        $this->fields->append($field);

        return $this;
    }
}
