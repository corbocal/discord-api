<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Component;

use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Resources\Component\AbstractComponent;
use Corbocal\DiscordApi\Resources\Component\Interfaces\ActionRowChildInterface;
use Corbocal\DiscordApi\Resources\Component\Interfaces\WebhookComponentInterface;
use Corbocal\DiscordApi\Validator\Validator;

class ActionRow extends AbstractComponent implements WebhookComponentInterface
{
    /**
     * @var ?ResourceCollection<int, ActionRowChildInterface>
     */
    protected ?ResourceCollection $childs = null;

    public function __construct()
    {
        parent::__construct(self::ACTION_ROW);
    }

    public function addChild(ActionRowChildInterface $child): self
    {
        if ($this->childs === null) {
            $this->childs = new ResourceCollection();
        }
        Validator::actionRowChilds($this->childs, $child);
        $this->childs->append($child);

        return $this;
    }
}
