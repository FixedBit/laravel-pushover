# A Pushover.net API implementation for Laravel 8

A simple, yet very powerful, package that helps you get started with sending push notifications to your iOS, Android or Desktop through the [pushover.net](https://pushover.net/) service.

### Content
- [A Pushover.net API implementation for Laravel 8](#a-pushovernet-api-implementation-for-laravel-8)
    - [Content](#content)
    - [Installation](#installation)
    - [Configuration](#configuration)
    - [Usage](#usage)
      - [Send message](#send-message)
      - [Get limits](#get-limits)
      - [Get receipt](#get-receipt)
    - [License](#license)

### Installation
To get the latest version of fixedbit/laravel-pushover simply require it in your `composer.json` file.

```bash
composer require fixedbit/laravel-pushover
```

This package utilizes the autodiscovery features of Laravel so the installation will be a breeze.

### Configuration
The only configuration you need to do is to add the following to your `.env` file

```js
PUSHOVER_TOKEN=[enter your token here]
PUSHOVER_USER=[place this your user key here]
```

### Usage
#### Send message
```php
// (REQUIRED) Import our PushoverMessage package
use Pushover\PushoverMessage;

// 1) Simple with just message
$message = new PushoverMessage('Taylor Otwell is a Legend')->send();

// 2) Simple with message and title
$message = new PushoverMessage('Learn Laravel from laracasts.com!', 'Learn Laravel')->send();

// 3) You can also choose to add a message (and/or) title as part of the chain
$message = new PushoverMessage()->message('Futurama Forever!')->title('Best TV Show')->send();
```

Advanced usage:
```php
$message = new PushoverMessage('My <b>message</b> content.', 'My title!');
        
$message->isHtml()
    ->sound('cashregister')
    ->url('http://example.com')
    ->urlTitle('ExampleSite')
    ->priority(1)
    ->device('my-main-device')
    ->send();
```

#### Get limits
To get your monthly limits, write the following:
```php
$limitation = new PushoverLimitation();

$limitsResponse = $limitation->get();

echo $limitsResponse->limit();
echo $limitsResponse->remaining();
echo $limitsResponse->reset();
```

#### Get receipt
When a message with priority `2` is sent, you can get a receipt to check on the acknowledgment of the message.

```php
$message = new PushoverMessage($this->faker->sentence, $this->faker->word);

$messageResponse = $message
    ->priority(2)
    ->retry(30)
    ->expire(120)
    ->send();

$receiptResponse = $messageResponse->receipt()->get();

// Available methods
$receiptResponse->acknowledged(); // returns boolean
$receiptResponse->acknowledgedAt(); // returns Carbon
$receiptResponse->acknowledgedBy(); // returns string
$receiptResponse->acknowledgedByDevice(); // returns string
$receiptResponse->lastDeliveredAt(); // returns Carbon
$receiptResponse->expired(); // returns boolean
$receiptResponse->expiresAt(); // returns Carbon
$receiptResponse->calledBack(); // returns boolean
$receiptResponse->calledBackAt(); // returns Carbon
```

### License

Copyright (c) 2022 Jason Hawks Licensed under the [MIT license](https://github.com/fixedbit/laravel-pushover/blob/master/LICENSE).

Forked from [Laravel Pushover](https://github.com/edwardkarlsson/laravel-pushover) by Edward Karlsson and updated with respect.