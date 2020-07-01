# nimble-php

PHP bindings to the Nimble CRM API

## Installation

This library requires PHP 7.1 and later

The recommended way to install nimble php is through [Composer](https://getcomposer.org):

This library is intended to speed up development time but is not a shortcut to reading the Nimble API documentation. Many endpoints require specific and required fields for successful operation. Always read the documentation before using an endpoint.

```sh
composer require mckltech/nimble-php
```

## Clients - API Key 

Initialize your client using your access token:

```php
use Nimble\NimbleClient;

$client = new NimbleClient('API_ACCESS_KEY_XXXX');
```

> - You can find your API Key by following the Nimble API documentation: https://support.nimble.com/en/articles/502755-nimble-api-access


## Support, Issues & Bugs

This library is unofficial and is not endorsed or supported by Nimble.

For bugs and issues, open an issue in this repo and feel free to submit a PR. Any issues that do not contain full logs or explainations will be closed. We need you to help us help you!

## API Versions

This library is intended to work with Version 1.3 of the Nimble Public API

## Users

```php
/** List Contacts */
$client->contacts->list();

/** Find Contact By Email */
$client->contacts->findBy('nimble@example.com');

/** Create A Contact */
$options = ['last name' => [['value' => 'Smith']], 'first name' => [['value' => 'Nimble']], 'email' => [['value' => 'nimble@example.com']]];

$payload = ['fields' => $options];

$client->contacts->create($payload);
```

## Supported Endpoints

All endpoints follow a similar mechanism to the examples show above. Again, please ensure you read the Nimble API documentation prior to use as there are numerous required fields for most POST/PUT operations.

- Contacts
- Users
- Company
- Tasks

## Exceptions

Exceptions are handled by HTTPlug. Every exception thrown implements `Http\Client\Exception`. See the [http client exceptions](http://docs.php-http.org/en/latest/httplug/exceptions.html) and the [client and server errors](http://docs.php-http.org/en/latest/plugins/error.html). If you want to catch errors you can wrap your API call into a try/catch block:

```php
try {
    $users = $client->contacts->list();
} catch(Http\Client\Exception $e) {
    if ($e->getCode() == '404') {
        // Handle 404 error
        return;
    } else {
        throw $e;
    }
}
```

## Credit

The layout and methodology used in this library is courtesy of https://github.com/intercom/intercom-php


