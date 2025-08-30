<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Common;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Resources\ComponentInterface;

abstract class AbstractComponent extends AbstractResource implements ComponentInterface
{
    protected const int ACTION_ROW = 1;
    protected const int BUTTON = 2;
    protected const int STRING_SELECT = 3;
    public function __construct(
        protected int $type,
        protected ?int $id = null,
    ) {
    }
}
