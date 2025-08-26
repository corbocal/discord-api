<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Message;

use Corbocal\DiscordApi\Resources\Message\AbstractMessage;

class SimpleMessage extends AbstractMessage
{
    // public function __construct(
    //     protected ?string $content,
    //     protected ?bool $enforceNonce = null,
    // ) {
    //     if (empty($content)) {
    //         $content = "Hello World! sent at " . date('Y-m-d H:i:s');
    //     }
    //     parent::__construct(
    //         content: $content,
    //         enforceNonce: $enforceNonce
    //     );
    // }
}
