<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Enums;

enum EmbedTypeEnums: string
{
    case RICH = 'rich';
    case IMAGE = 'image';
    case VIDEO = 'video';
    case GIFV = 'gifv';
    case ARTICLE = 'article';
    case LINK = 'link';
    case POLL_RESULT = 'poll_result';
}
