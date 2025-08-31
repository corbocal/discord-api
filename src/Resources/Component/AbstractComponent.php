<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Component;

use Corbocal\DiscordApi\Resources\AbstractResource;
use Corbocal\DiscordApi\Resources\Component\Interfaces\ComponentInterface;

abstract class AbstractComponent extends AbstractResource implements ComponentInterface
{
    protected const int ACTION_ROW = 1;
    protected const int BUTTON = 2;
    protected const int STRING_SELECT = 3;
    protected const int TEXT_INPUT = 4;
    protected const int USER_SELECT = 5;
    protected const int ROLE_SELECT = 6;
    protected const int MENTIONABLE_SELECT = 7;
    protected const int CHANNEL_SELECT = 8;
    protected const int SECTION = 9;
    protected const int TEXT_DISPLAY = 10;
    protected const int THUMBNAIL = 11;
    protected const int MEDIA_GALLERY = 12;
    protected const int FILE = 13;
    protected const int SEPARATOR = 14;
    protected const int CONTAINER = 17;
    protected const int LABEL = 18;

    public function __construct(
        protected int $type,
        protected ?int $id = null,
    ) {
    }
}
