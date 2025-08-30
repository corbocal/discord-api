<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\ActionRowChildInterface;
use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Resources\Common\AbstractComponent;

class ActionRow extends AbstractComponent
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
        $this->childs->append($child);

        return $this;
    }
}
