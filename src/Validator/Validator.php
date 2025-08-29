<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Validator;

use Corbocal\DiscordApi\Exceptions\ValidationException;
use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Resources\Common\Embed;
use Corbocal\DiscordApi\Resources\Common\Field;
use Corbocal\DiscordApi\Resources\Common\File;
use Corbocal\DiscordApi\Resources\Enums\EmbedTypeEnums;
use Corbocal\DiscordApi\Resources\ResourceInterface;

class Validator
{
    public const string PATTERN_SNOWFLAKE = "/[0-9]{18+}/";
    public const string PATTERN_HEXA_COLOR = "/^#?[0-9A-F]{6}$/";

    public const string PATTERN_WEBHOOK = "/^https:\/\/discord.com\/api\/webhooks\/[0-9]{9,19}\/[a-zA-Z0-9\_\-]{68,100}$/";

    public const int EMBED_QTY = 10;
    public const int FILES_QTY = 10;
    public const int WEBHOOK_NAME_LENGTH = 80;

    public const int FIELD_NAME_LENGTH = 256;
    public const int FIELD_VALUE_LENGTH = 1024;
    public const int FIELD_QTY = 25;

    public static function snowflake(string|int $snowflake): void
    {
        if (!preg_match(self::PATTERN_SNOWFLAKE, (string) $snowflake)) {
            throw new ValidationException("The passed ID is not in the snowflake format.");
        }
    }

    public static function fullWebhook(string $webhook = "", bool $canBeEmpty = false): void
    {
        if ($canBeEmpty && empty($webhook)) {
            return;
        }

        if (!preg_match(self::PATTERN_WEBHOOK, $webhook)) {
            throw new ValidationException(
                "The full webhook path should look like "
                . "https://discord.com/api/webhooks/223704706495545344/"
                . "3d89bb7572e0fb30d8128367b3b1b44fecd17-6de135cbe28a41f8b2_777c372ba2939e72279b94526ff5d1bd4358d65cf11"
            );
        }
    }

    public static function webhookName(?string $name): void
    {
        if ($name === null) {
            return;
        }

        if (strlen($name) > self::WEBHOOK_NAME_LENGTH) {
            throw new ValidationException("The webhook name length must be " . self::WEBHOOK_NAME_LENGTH . " max.");
        }
    }

    public static function color(?string $color): void
    {
        if ($color === null) {
            return;
        }

        if (!preg_match(self::PATTERN_HEXA_COLOR, $color)) {
            throw new ValidationException("The color does not match the hexadecimal color pattern.");
        }
    }

    /**
     * @param ?ResourceCollection<int, File> $files
     *
     * @throws ValidationException
     *
     * @return void
     */
    public static function filesMaxNumber(?ResourceCollection $files): void
    {
        if ($files === null) {
            return;
        }

        if ($files->count() > self::FILES_QTY) {
            throw new ValidationException("The number of files cannot be higher than " . self::FILES_QTY . ".");
        }
    }

    public static function fileExists(?string $fullpath): void
    {
        if ($fullpath === null) {
            return;
        }

        if (realpath($fullpath) === false || !is_file($fullpath)) {
            throw new ValidationException("The file $fullpath does not exist.");
        }
    }

    /**
     * @param ?ResourceCollection<int, Embed> $embeds
     *
     * @throws ValidationException
     *
     * @return void
     */
    public static function embedMaxNumber(?ResourceCollection $embeds): void
    {
        if ($embeds === null) {
            return;
        }

        if ($embeds->count() > self::EMBED_QTY) {
            throw new ValidationException("The number of embeded object cannot be higher than " . self::EMBED_QTY . ".");
        }
    }

    public static function embedTypeIsRichForWebhook(Embed $embed): void
    {
        if ($embed->getType() !== EmbedTypeEnums::RICH) {
            throw new ValidationException("The Embeded object type must be 'rich' when used in a webhook.");
        }
    }

    public static function fieldNameLength(string $name): void
    {
        if (strlen($name) > self::FIELD_NAME_LENGTH) {
            throw new ValidationException("The field name `$name` is too long (" . self::FIELD_NAME_LENGTH . " chars max.).");
        }
    }

    public static function fieldValueLength(string $value): void
    {
        if (strlen($value) > self::FIELD_VALUE_LENGTH) {
            throw new ValidationException("The field value `$value` is too long (" . self::FIELD_VALUE_LENGTH . " chars max.).");
        }
    }

    /**
     * @param ?ResourceCollection<int, Field> $fields
     *
     * @throws ValidationException
     *
     * @return void
     */
    public static function fieldsdMaxNumberInEmbed(?ResourceCollection $fields): void
    {
        if ($fields === null) {
            return;
        }
        if ($fields->count() > self::FIELD_QTY) {
            throw new ValidationException("The embeded fields number cannot be higher than " . self::FIELD_QTY . ".");
        }
    }
}
