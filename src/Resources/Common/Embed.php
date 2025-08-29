<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Resources\Common\Footer;
use Corbocal\DiscordApi\Resources\Common\Provider;
use Corbocal\DiscordApi\Resources\Common\Thumbnail;
use Corbocal\DiscordApi\Resources\Common\Video;
use Corbocal\DiscordApi\Resources\Enums\EmbedTypeEnums;
use Corbocal\DiscordApi\Validator\Validator;
use DateTimeInterface;

class Embed extends AbstractResource
{
    /**
     * @var ?ResourceCollection<int, Field>
     */
    protected ?ResourceCollection $fields = null;

    protected ?Footer $footer = null;

    protected ?Thumbnail $thumbnail = null;

    protected ?Video $video = null;

    protected ?Provider $provider = null;

    protected ?Author $author = null;

    public function __construct(
        protected ?string $title = null,
        protected ?EmbedTypeEnums $type = null,
        protected ?string $description = null,
        protected ?string $url = null,
        protected ?DateTimeInterface $timestamp = null,
        protected ?string $color = null,
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

    public function withFooter(Footer $footer): self
    {
        $this->footer = $footer;

        return $this;
    }


    public function withThumbnail(Thumbnail $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function withVideo(Video $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function withProvider(Provider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function withAuthor(Author $author): self
    {
        $this->author = $author;

        return $this;
    }
}
