<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Resources\Common\SelectOption;
use Corbocal\DiscordApi\Resources\Component\AbstractComponent;
use Corbocal\DiscordApi\Resources\Component\Interfaces\ChildSelectInterface;
use Corbocal\DiscordApi\Resources\Component\Interfaces\WebhookComponentInterface;
use Corbocal\DiscordApi\Validator\Validator;

class StringSelect extends AbstractComponent implements ChildSelectInterface, WebhookComponentInterface
{
    /**
     * @var ?ResourceCollection<int, SelectOption>
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
        Validator::customIdMaxSize($customId);
        parent::__construct(self::STRING_SELECT);
    }
}
