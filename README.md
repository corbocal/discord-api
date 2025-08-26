# Introduction

This package is a work in progress.
EVERYTHING should be taken with a pinch of salt as some major changes could be made until the first stable release.

## Instanciation

A wrapper `DiscordClient.php` is used to instantiate wether the API client or the Webhook client.
As mentioned in the Discord API documentation : "Webhooks are a low-effort way to post messages to channels in Discord. They do not require a bot user or authentication to use."

Hence webhooks are being treated first :D

```php
$resource = new ExecuteWebhook();
$resource->withContent("This is some impactful content");
$embed = new Embed(
            "An important message",
            EmbedTypeEnums::RICH,
            "I'm testing stuff",
            null,
            new DateTimeImmutable("now"),
            '#A1B'
        );
$embed->addField(new Field("Some stuff happened", "The worst person in the world made a correct statement."));
$resource->addEmbed($embed);
$resource->getLastEmbed()->addField("Breaking news!", "Nothing happened!")

$client = DiscordClient::getWebhookClient("https://discord.com/api/webhooks/140.../T0k3n...");
$client->execute($resource);
```
