# Introduction

This package is a **work in progress**.

EVERYTHING should be taken with a pinch of salt as some major changes could happen until the first stable release (v1.0.0).

This package aims to offer a variety of simple tools to send messages or interact with webhooks on Discord.

## How to ?

As mentioned in the Discord API documentation :
```
"Webhooks are a low-effort way to post messages to channels in Discord.
They do not require a bot user or authentication to use."
```

Hence webhooks are being treated first :D

A wrapper, `DiscordClient.php`, is used to instantiate wether the API client or the Webhook client.

The main class to get an object from is `ExecuteWebhook`.

Everything that can be sent to Discord as part of a webhook or message has its Object equivalent.

```php
$resource = new ExecutableWebhook();
$resource->withContent("This is some impactful content.");

$embed = new Embed(
            "An important message",
            EmbedTypeEnums::RICH,
            "I'm testing stuff",
            "https://www.youtube.com/watch?v=dQw4w9WgXcQ",
            new DateTimeImmutable("now"),
            '#FC95F9'
        );
$embed->addField(new Field("Some stuff happened", "The worst person in the world made a correct statement."));

$resource->addEmbed($embed);

$client = DiscordClient::getWebhookClient("https://discord.com/api/webhooks/140.../T0k3n...");
$client->execute($resource);
```

### Useful links

- [Discord API documentation](https://discord.com/developers/docs/reference)
    - [Webhooks](https://discord.com/developers/docs/resources/webhook)
