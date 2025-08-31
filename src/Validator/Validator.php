<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Validator;

use Corbocal\DiscordApi\Exceptions\ValidationException;
use Corbocal\DiscordApi\Resources\Classes\ResourceCollection;
use Corbocal\DiscordApi\Resources\Common\Embed;
use Corbocal\DiscordApi\Resources\Common\Field;
use Corbocal\DiscordApi\Resources\Common\File;
use Corbocal\DiscordApi\Resources\Common\SelectDefault;
use Corbocal\DiscordApi\Resources\Component\Button;
use Corbocal\DiscordApi\Resources\Component\Interfaces\ActionRowChildInterface;
use Corbocal\DiscordApi\Resources\Component\Interfaces\ChildSelectInterface;
use Corbocal\DiscordApi\Resources\Component\Interfaces\ComponentInterface;
use Corbocal\DiscordApi\Resources\Enums\EmbedTypeEnums;
use Corbocal\DiscordApi\Resources\Poll\PollAnswer;

class Validator
{
    public const string PATTERN_SNOWFLAKE = "/[0-9]{18+}/";
    public const string PATTERN_HEXA_COLOR = "/^#?[0-9A-F]{6}$/";
    public const string PATTERN_WEBHOOK = "/^https:\/\/discord.com\/api\/webhooks\/[0-9]{9,19}\/[a-zA-Z0-9\_\-]{68,100}$/";

    public const int CUSTOM_ID_MAX_SIZE = 100;

    public const int EMBED_QTY = 10;
    public const int FILES_QTY = 10;
    public const int FIELD_QTY = 25;
    public const int COMPONENT_QTY = 40;

    public const int WEBHOOK_NAME_MAX_LENGTH = 80;
    public const int BASE_TEXT_MAX_LENGTH = 2000;
    public const int FOOTER_TEXT_MAX_LENGTH = 2048;
    public const int FIELD_NAME_MAX_LENGTH = 256;
    public const int FIELD_VALUE_MAX_LENGTH = 1024;

    public const int POLL_QUESTION_TEXT_MAX_LENGTH = 300;
    public const int POLL_ANSWER_TEXT_MAX_LENGTH = 55;
    public const int POLL_MAX_ANSWERS = 10;
    public const int POLL_MAX_DURATION = 768; // hours (32 days)



    public const int ACTION_ROW_MAX_BUTTONS = 5;
    public const int ACTION_ROW_MAX_SELECT = 1;
    public const int BUTTON_LABEL_MAX_SIZE = 80;
    public const int USER_SELECT_PLACEHOLDER_MAX_SIZE = 150;
    public const int USER_SELECT_MIN_MIN_VALUES = 0;
    public const int USER_SELECT_MAX_MIN_VALUES = 25;
    public const int USER_SELECT_MIN_MAX_VALUES = 1;
    public const int USER_SELECT_MAX_MAX_VALUES = 25;

    public static function snowflake(string|int $snowflake): void
    {
        if (!preg_match(self::PATTERN_SNOWFLAKE, (string) $snowflake)) {
            throw new ValidationException("The passed ID is not in the snowflake format.");
        }
    }

    public static function customIdMaxSize(string $text): void
    {
        if (strlen($text) > self::CUSTOM_ID_MAX_SIZE) {
            throw new ValidationException("The custom id length is too long (" . self::CUSTOM_ID_MAX_SIZE . " chars max.).");
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

    public static function baseTextLength(string $text): void
    {
        if (strlen($text) > self::BASE_TEXT_MAX_LENGTH) {
            throw new ValidationException("The text length must be " . self::BASE_TEXT_MAX_LENGTH . " chars max.");
        }
    }

    public static function fullWebhookSyntax(string $webhook = "", bool $canBeEmpty = false): void
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

        if (strlen($name) > self::WEBHOOK_NAME_MAX_LENGTH) {
            throw new ValidationException("The webhook name is too long (" . self::WEBHOOK_NAME_MAX_LENGTH . " chars max.).");
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
            throw new ValidationException("The number of files cannot be greater than " . self::FILES_QTY . ".");
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
            throw new ValidationException("The number of embeded object cannot be greater than " . self::EMBED_QTY . ".");
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
        if (strlen($name) > self::FIELD_NAME_MAX_LENGTH) {
            throw new ValidationException("The field name `$name` is too long (" . self::FIELD_NAME_MAX_LENGTH . " chars max.).");
        }
    }

    public static function fieldValueLength(string $value): void
    {
        if (strlen($value) > self::FIELD_VALUE_MAX_LENGTH) {
            throw new ValidationException("The field value `$value` is too long (" . self::FIELD_VALUE_MAX_LENGTH . " chars max.).");
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
            throw new ValidationException("The embeded fields number cannot be greater than " . self::FIELD_QTY . ".");
        }
    }

    public static function footerTextMaxValue(string $text): void
    {
        if (strlen($text) > self::FOOTER_TEXT_MAX_LENGTH) {
            throw new ValidationException("The footer text is too long (" . self::FOOTER_TEXT_MAX_LENGTH . " chars max.).");
        }
    }

    public static function pollQuestionTextMaxLength(string $text): void
    {
        if (strlen($text) > self::POLL_QUESTION_TEXT_MAX_LENGTH) {
            throw new ValidationException("The poll question text is too long (" . self::POLL_QUESTION_TEXT_MAX_LENGTH . " chars max.).");
        }
    }

    public static function pollAnswerTextMaxLength(string $text): void
    {
        if (strlen($text) > self::POLL_ANSWER_TEXT_MAX_LENGTH) {
            throw new ValidationException("The poll answer text is too long (" . self::POLL_ANSWER_TEXT_MAX_LENGTH . " chars max.).");
        }
    }

    /**
     * @param ?ResourceCollection<int, PollAnswer> $answers
     *
     * @throws ValidationException
     *
     * @return void
     */
    public static function pollMaxAnswerNumber(?ResourceCollection $answers): void
    {
        if ($answers === null) {
            return;
        }

        if ($answers->count() > self::POLL_MAX_ANSWERS) {
            throw new ValidationException("The number of poll answers cannot be greater than " . self::POLL_MAX_ANSWERS . ".");
        }
    }

    public static function pollDuration(?int $duration): void
    {
        if ($duration === null) {
            return;
        }

        if ($duration < 1 || $duration > self::POLL_MAX_DURATION) {
            throw new ValidationException("The poll duration must be between 1 and " . self::POLL_MAX_DURATION . " hours (32 days).");
        }
    }

    public static function buttonLabelMaxSize(string $text): void
    {
        if (strlen($text) > self::BUTTON_LABEL_MAX_SIZE) {
            throw new ValidationException("The button label is too long (" . self::BUTTON_LABEL_MAX_SIZE . " chars max.).");
        }
    }

    /**
     * @param ?ResourceCollection<int, ComponentInterface> $components
     *
     * @throws ValidationException
     *
     * @return void
     */
    public static function componentsMaxNumber(?ResourceCollection $components): void
    {
        if ($components === null) {
            return;
        }

        if ($components->count() > self::COMPONENT_QTY) {
            throw new ValidationException("The number of components cannot be higher than " . self::COMPONENT_QTY . ".");
        }
    }

    /**
     * An Action Row can only have up to 5 Buttons or a single Select element.
     *
     * @param ?ResourceCollection<int, ActionRowChildInterface> $childs
     * @param ActionRowChildInterface $child
     *
     * @throws ValidationException
     *
     * @return void
     */
    public static function actionRowChilds(?ResourceCollection $childs, ActionRowChildInterface $child): void
    {
        if ($childs === null) {
            return;
        }

        if ($childs->count() >= self::ACTION_ROW_MAX_SELECT && ($last = $childs->getLast()) !== null) {
            // if the collection already contains a Select, it cannot contain anything else.
            if ($last instanceof ChildSelectInterface) {
                throw new ValidationException("An Action Row cannot contain more than one Select Component.");
            }

            // if the collection contains a Button, it cannot contain anything other than a button.
            if ($last instanceof Button && !$child instanceof Button) {
                throw new ValidationException("An Action Row containing a Button cannot contain anything else than a Button.");
            }

            // the collection cannot contain more than 5 elements, which must be Buttons
            if ($childs->count() >= self::ACTION_ROW_MAX_BUTTONS) {
                throw new ValidationException("An Action Row cannot contain more than " . self::ACTION_ROW_MAX_BUTTONS . " Components.");
            }
        }
    }

    public static function selectPlaceholderMaxSize(string $text): void
    {
        if (strlen($text) > self::USER_SELECT_PLACEHOLDER_MAX_SIZE) {
            throw new ValidationException("The User Select placeholder is too long ("
                . self::USER_SELECT_PLACEHOLDER_MAX_SIZE . " chars max.).");
        }
    }


    public static function selectMinValuesRange(?int $value): void
    {
        if ($value < self::USER_SELECT_MIN_MIN_VALUES || $value > self::USER_SELECT_MAX_MIN_VALUES) {
            throw new ValidationException("The User Select minValues must be between " .
                self::USER_SELECT_MIN_MIN_VALUES . " and "
                . self::USER_SELECT_MAX_MIN_VALUES);
        }
    }

    public static function selectMaxValuesRange(?int $value): void
    {
        if ($value < self::USER_SELECT_MIN_MAX_VALUES || $value > self::USER_SELECT_MAX_MAX_VALUES) {
            throw new ValidationException("The User Select maxValues must be between " .
                self::USER_SELECT_MIN_MAX_VALUES . " and "
                . self::USER_SELECT_MAX_MAX_VALUES);
        }
    }

    /**
     * @param ?ResourceCollection<int, SelectDefault> $defaultsValues
     * @param int $minValues
     * @param int $maxValues
     *
     * @throws ValidationException
     *
     * @return void
     */
    public static function selectDefaultValuesRange(
        ?ResourceCollection $defaultsValues,
        int $minValues,
        int $maxValues
    ): void {
        if ($defaultsValues === null) {
            return;
        }

        $count = $defaultsValues->count();
        if ($count < $minValues || $count >= $maxValues) {
            throw new ValidationException("The number of defaultValues for User Select must be between $minValues and $maxValues.");
        }
    }
}
