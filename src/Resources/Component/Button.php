<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\ActionRowChildInterface;
use Corbocal\DiscordApi\Resources\Common\AbstractComponent;
use Corbocal\DiscordApi\Resources\Emoji\PartialEmoji;
use Corbocal\DiscordApi\Resources\Enums\ButtonStylesEnum;

class Button extends AbstractComponent implements ActionRowChildInterface
{
    public function __construct(
        protected ButtonStylesEnum $style,
        protected string $customId,
        protected ?string $label = null,
        // protected ?PartialEmoji $emoji,
        protected ?string $url = null,
        protected ?bool $disabled = null,
        protected ?string $skuId = null,
    ) {
        parent::__construct(self::BUTTON);
    }
}
