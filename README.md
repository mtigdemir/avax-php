# AVAX Client for PHP

[![Build Status](https://travis-ci.org/mtigdemir/ava-php.svg?branch=master)](https://travis-ci.org/mtigdemir/ava-php)

PHP Client Wrapper for AVA Nodes https://docs.avax.network/build/avalanchego-apis

## Requirements
- Up & running AVA Node to use PHP Client

```bash
$ composer require mtigdemir/ava-php
```

## Initialize AVA Client
```php
// Default Connection (127.0.0.1:9650)
$client = new \AVA\AVAClient();

$username = "php-ava";
$password = "ava-password";
```

## Key Store
```php
$client->keyStore->createUser($username, $password);
$client->keyStore->deleteUser($username, $password);
```

## X-Chain
```php
$client->xchain->createAddress($username, $password);
$client->xchain->listAddresses($username, $password);
$client->xchain->send($username, $password, $receiverAddress); // Default Asset AVA
$client->xchain->getBalance($address); // Default Asset AVA
```

## P-Chain

```php
$client->pchain->createAccount($username, $password);
```

## Admin

```php
$client->admin->nodeID();
$client->admin->networkName();
```
