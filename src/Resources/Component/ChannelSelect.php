<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Resources\Component\AbstractComponent;
use Corbocal\DiscordApi\Resources\Component\Interfaces\ChildSelectInterface;
use Corbocal\DiscordApi\Resources\Component\Interfaces\WebhookComponentInterface;
use Corbocal\DiscordApi\Resources\Enums\ChannelTypesEnum;
use Corbocal\DiscordApi\Validator\Validator;

class ChannelSelect extends AbstractComponent implements ChildSelectInterface, WebhookComponentInterface
{
    /**
     * @var ?ResourceCollection<int, SelectDefault>
     */
    protected ?ResourceCollection $defaultValues = null;

    /**
     * @param string $customId
     * @param ?ChannelTypesEnum[] $chanelTypes
     * @param ?string $placeholder
     * @param int $minValues
     * @param int $maxValues
     * @param ?bool $disabled
     */
    public function __construct(
        protected string $customId,
        protected ?array $chanelTypes = null,
        protected ?string $placeholder = null,
        protected int $minValues = 0,
        protected int $maxValues = 1,
        protected ?bool $disabled = null,
    ) {
        Validator::customIdMaxSize($customId);
        Validator::selectPlaceholderMaxSize($placeholder ?? "");
        Validator::selectMinValuesRange($minValues);
        Validator::selectMaxValuesRange($maxValues);
        parent::__construct(self::CHANNEL_SELECT);
    }

    public function addDefaultValue(SelectDefault $default): self
    {
        Validator::selectDefaultValuesRange(
            $this->defaultValues,
            0,
            $this->maxValues
        );
        if ($this->defaultValues === null) {
            $this->defaultValues = new ResourceCollection();
        }
        $this->defaultValues->append($default);

        return $this;
    }

    public function toArray(): array
    {
        Validator::selectDefaultValuesRange(
            $this->defaultValues,
            $this->minValues,
            $this->maxValues
        );
        return parent::toArray();
    }
}
