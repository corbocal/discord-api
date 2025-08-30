<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\ActionRowChildInterface;
use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Resources\Common\AbstractComponent;
use Corbocal\DiscordApi\Resources\Common\Field;

class StringSelect extends AbstractComponent implements ActionRowChildInterface
{
    /**
     * @var ?ResourceCollection<int, Field>
     */
    protected ?ResourceCollection $options = null;

    public function __construct(
        protected string $customId,
        protected ?string $label = null,
        protected ?string $placeholder = null,
        protected ?int $minValues = null,
        protected ?int $maxValues = null,
        protected ?bool $required = null,
        protected ?bool $disabled = null,
    ) {
        parent::__construct(self::STRING_SELECT);
    }
}
