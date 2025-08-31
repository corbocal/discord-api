<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Component;

use Corbocal\DiscordApi\Resources\Component\AbstractComponent;
use Corbocal\DiscordApi\Resources\Component\Interfaces\ActionRowChildInterface;
use Corbocal\DiscordApi\Resources\Component\Interfaces\WebhookComponentInterface;
use Corbocal\DiscordApi\Resources\Emoji\PartialEmoji;
use Corbocal\DiscordApi\Resources\Enums\ButtonStylesEnum;
use Corbocal\DiscordApi\Validator\Validator;

class Button extends AbstractComponent implements ActionRowChildInterface, WebhookComponentInterface
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
        Validator::buttonLabelMaxSize($label ?? "");
        Validator::customIdMaxSize($customId);
        parent::__construct(self::BUTTON);
    }
}
